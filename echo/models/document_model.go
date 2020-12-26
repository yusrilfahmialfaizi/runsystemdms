package models

import (
	"database/sql"
	"echo/config"
	"fmt"
	//"strconv"

	nullable "gopkg.in/guregu/null.v3"
)

type Datadocument struct {
	Docno       string          `json:"docno"`
	ModulCode   string          `json:"modulcode"`
	ModulName   string          `json:"modulname"`
	ActiveInd   string          `json:"activeind"`
	Status	  string          `json:"status"`
	CreateBy    string          `json:"createby"`
	CreateDt    string          `json:"createdt"`
	LastupBy    nullable.String `json:"lastupby"`
	LastupDt    nullable.String `json:"lastupdt"`
}

type InsDatadocument struct {
	Docno       string          `json:"docno"`
	ModulCode   string          `json:"modulcode"`
	Status      string          `json:"status"`
	ActiveInd   string          `json:"activeind"`
	MenuCode    string          `json:"menucode"`
	Description string          `json:"description"`
	CreateBy    string          `json:"createby"`
	CreateDt    string          `json:"createdt"`
	LastUpBy    string 		   `json:"lastupby"`
	LastUpDt    string    	   `json:"lastupdt"`
}
type InsDatadocumentDtl struct {
	Docno       string          `json:"docno"`
	MenuCode    string          `json:"menucode"`
	CreateBy    string          `json:"createby"`
	CreateDt    string          `json:"createdt"`
	LastUpBy    string 		   `json:"lastupby"`
	LastUpDt    string    	   `json:"lastupdt"`
}
type UpDatadocumentHdr struct {
	Docno       string          `json:"docno"`
	Status      string          `json:"status"`
	LastUpBy    string 		   `json:"lastupby"`
	LastUpDt    string    	   `json:"lastupdt"`
}
type DocDtl struct {
	Docno       string          `json:"docno"`
	MenuCode    string          `json:"menucode"`
	Description nullable.String `json:"description"`
	Status      string          `json:"status"`
	CreateBy    string          `json:"createby"`
	CreateDt    string          `json:"createdt"`
	LastUpBy    nullable.String `json:"lastupby"`
	LastUpDt    nullable.String `json:"lastupdt"`
}
type DocDtlJoin struct {
	Docno       string          `json:"docno"`
	MenuCode    string          `json:"menucode"`
	ModulCode   string          `json:"modulcode"`
	MenuDesc 	  string          `json:"menudesc"`
	Parent   	  nullable.String `json:"parent"`
	Status      string          `json:"status"`
}
type DocDtlJoinPrint struct {
	Docno       string          `json:"docno"`
	MenuCode    string          `json:"menucode"`
	Description nullable.String `json:"description"`
	ModulCode   string          `json:"modulcode"`
	MenuDesc 	  string          `json:"menudesc"`
	Parent   	  nullable.String `json:"parent"`
	Status      string          `json:"status"`
}

type DocumentsDtl struct {
	DocumentsDtl []DocDtl `json:"documentsdtl"`
}
type DocumentsDtlJoin struct {
	DocumentsDtlJoin []DocDtlJoin `json:"documentsdtl"`
}
type DocumentsDtlJoinPrint struct {
	DocumentsDtlJoinPrint []DocDtlJoinPrint `json:"documentsdtl"`
}
type Datadocuments struct {
	Datadocuments []Datadocument `json:"datadocument"`
}
type InsDatadocuments struct {
	InsDatadocuments []InsDatadocument `json:"insdatadocument"`
}
type GenerateCodes struct {
	DocNo sql.NullInt64 `json:"docno"`
}

var connection *sql.DB

//function untuk get document yang ditampilkan di view tabel
func GetDatadocuments(c *CustomContext) Datadocuments {
	connection := config.Connection()
	modulcode := c.Param("modulcode");
	query := "SELECT A.Docno, A.ModulCode, B.ModulName, A.ActiveInd, A.`Status`, A.CreateBy, A.CreateDt, A.LastUpBy, A.LastUpDt FROM tbldocumenthdr A INNER JOIN tblmodul B ON B.ModulCode = A.ModulCode WHERE A.modulcode = ? ORDER BY A.CreateDt DESC"
	rows, err := connection.Query(query, modulcode)
	if err != nil {
		fmt.Println(err)
	}
	defer rows.Close()
	result := Datadocuments{}

	for rows.Next() {
		datadocument := Datadocument{}

		eror := rows.Scan(&datadocument.Docno, &datadocument.ModulCode, &datadocument.ModulName, &datadocument.ActiveInd, &datadocument.Status, &datadocument.CreateBy, &datadocument.CreateDt, &datadocument.LastupBy, &datadocument.LastupDt)
		if eror != nil {
			fmt.Println(eror)
		}
		result.Datadocuments = append(result.Datadocuments, datadocument)
	}
	return result
}
func GetDatadocumentsHdr(c *CustomContext) Datadocuments {
	connection 	:= config.Connection()
	docno 		:= c.FormValue("docno");
	query 		:= "SELECT * FROM tbldocumenthdr WHERE Docno = ? ORDER BY CreateDt DESC"
	rows, err := connection.Query(query, docno)
	if err != nil {
		fmt.Println(err)
	}
	defer rows.Close()
	result := Datadocuments{}

	for rows.Next() {
		datadocument := Datadocument{}

		eror := rows.Scan(&datadocument.Docno, &datadocument.ModulCode, &datadocument.ActiveInd, &datadocument.Status, &datadocument.CreateBy, &datadocument.CreateDt, &datadocument.LastupBy, &datadocument.LastupDt)
		if eror != nil {
			fmt.Println(eror)
		}
		result.Datadocuments = append(result.Datadocuments, datadocument)
	}
	return result
}


	
//function untuk untuk edit active indicator documenthdr
func EditActiveInd(con *sql.DB, ModulCode string) (int64, error) {
	con = config.Connection()
	query1 := "UPDATE tbldocumenthdr SET ActiveInd = 'N' WHERE modulcode = ?"
		stmt1, err1 := con.Prepare(query1)
		if err1 != nil {
			panic(err1)
		}
		defer stmt1.Close()
		result, er1 := stmt1.Exec(ModulCode)
		if er1 != nil {
			panic(er1)
		}
	
	return result.RowsAffected()
}
//function untuk untuk post data documenthdr yang ditampilkan di view tabel
func PostDataDocuments(con *sql.DB, Docno string, ModulCode string, Status string, ActiveInd string, CreateBy string, CreateDt string, LastUpBy string, LastUpDt string) (int64, error) {
	con = config.Connection()

	query2 := "INSERT INTO tbldocumenthdr (docno, modulcode, activeind, status, createby, createdt, lastupby, lastupdt) values (?,?,?,?,?,?,?,?)"
	stmt2, err2 := con.Prepare(query2)

	if err2 != nil {

		fmt.Println(err2)
	}
	defer stmt2.Close()

	result, er2 := stmt2.Exec(Docno, ModulCode, ActiveInd, Status, CreateBy, CreateDt, LastUpBy, LastUpDt)

	if er2 != nil {
		panic(er2)
	}
	GetdataMenuCode1(ModulCode, Docno, CreateBy, CreateDt, LastUpBy, LastUpDt)
	return result.RowsAffected()
}
func GetdataMenuCode1(ModulCode string, Docno string, CreateBy string, CreateDt string, LastUpBy string, LastUpDt string) Add {
	connection := config.Connection()
	query3 := "SELECT A.MenuCode, A.ModulCode, A.MenuDesc, A.Parent, A.CreateBy, A.CreateDt, A.LastUpBy, A.LastUpDt FROM tblmodulmenu A WHERE modulcode = ?"
	stmt3, err3 := connection.Query(query3, ModulCode)
	if err3 != nil {
		panic(err3)
	}
	defer stmt3.Close()
	result := Add{}

	for stmt3.Next() {
		modulmenu := MenuAddDocument{}

		er3 := stmt3.Scan(&modulmenu.MenuCode, &modulmenu.ModulCode, &modulmenu.MenuDesc, &modulmenu.Parent, &modulmenu.CreateBy, &modulmenu.CreateDt, &modulmenu.LastupBy, &modulmenu.LastupDt)
		if er3 != nil {
			panic(er3)
		}

		// fmt.Println(Docno, modulmenu.MenuCode, CreateBy, CreateDt, LastUpBy, LastUpDt)
		// PostDataDocumentsDtl1(Docno, modulmenu.MenuCode, CreateBy, CreateDt, LastUpBy, LastUpDt)
		query := "INSERT INTO tbldocumentdtl (docno, menucode, createby, createdt, lastupby, lastupdt) values (?,?,?,?,?,?)"
		stmt, err := connection.Prepare(query)
		if err != nil {
		fmt.Println(err)
		}
		// Make sure to cleanup after the program exits
		defer stmt.Close()
		_, err2 := stmt.Exec(Docno, modulmenu.MenuCode, CreateBy, CreateDt, LastUpBy, LastUpDt)
		if err2 != nil {
			fmt.Println(err2)
		}
		
		result.Add = append(result.Add, modulmenu)
	}
	return result
}
func GetdataMenuCode(c *CustomContext) Add {
	connection := config.Connection()
	ModulCode := c.FormValue("modulcode");
	query3 := "SELECT A.MenuCode, A.ModulCode, A.MenuDesc, A.Parent, A.CreateBy, A.CreateDt, A.LastUpBy, A.LastUpDt FROM tblmodulmenu A WHERE modulcode = ?"
	stmt3, err3 := connection.Query(query3, ModulCode)
	if err3 != nil {
		panic(err3)
	}
	defer stmt3.Close()
	result := Add{}

	for stmt3.Next() {
		modulmenu := MenuAddDocument{}

		er3 := stmt3.Scan(&modulmenu.MenuCode, &modulmenu.ModulCode, &modulmenu.MenuDesc, &modulmenu.Parent, &modulmenu.CreateBy, &modulmenu.CreateDt, &modulmenu.LastupBy, &modulmenu.LastupDt)
		if er3 != nil {
			panic(er3)
		}
		result.Add = append(result.Add, modulmenu)
	}
	return result
}

//function untuk untuk post data documentdtl yang ditampilkan di view tabel
func PostDataDocumentsDtl1(Docno string, MenuCode string, CreateBy string, CreateDt string, LastUpBy string, LastUpDt string) (int64, error) {
	connnection := config.Connection()
	query := "INSERT INTO tbldocumentdtl (docno, menucode, createby, createdt, lastupby, lastupdt) values (?,?,?,?,?,?)"
	// Create a prepared SQL statement
	stmt, err := connnection.Prepare(query)

	// / Exit if we get an error
	if err != nil {
		fmt.Println(err)
	}
	// Make sure to cleanup after the program exits
	defer stmt.Close()

	//The sql stat wll return the id, so we can use it.
	result, err2 := stmt.Exec(Docno, MenuCode, CreateBy, CreateDt, LastUpBy, LastUpDt)

	// Exit if we get an error
	if err2 != nil {
		fmt.Println(err2)
	}

	return result.RowsAffected()
}
//function untuk untuk post data documentdtl yang ditampilkan di view tabel
func PostDataDocumentsDtl(con *sql.DB, Docno string, MenuCode string, CreateBy string, CreateDt string, LastUpBy string, LastUpDt string) (int64, error) {
	con = config.Connection()
	query := "INSERT INTO tbldocumentdtl (docno, menucode, createby, createdt, lastupby, lastupdt) values (?,?,?,?,?,?)"
	// Create a prepared SQL statement
	stmt, err := con.Prepare(query)

	// / Exit if we get an error
	if err != nil {
		fmt.Println(err)
	}
	// Make sure to cleanup after the program exits
	defer stmt.Close()

	//The sql stat wll return the id, so we can use it.
	result, err2 := stmt.Exec(Docno, MenuCode, CreateBy, CreateDt, LastUpBy, LastUpDt)

	// Exit if we get an error
	if err2 != nil {
		fmt.Println(err2)
	}

	return result.RowsAffected()
}

//function untuk untuk edit data documenthdr yang ditampilkan di view tabel
func EditDocDtl(con *sql.DB, Docno string, MenuCode string, Description string, Status string,  LastUpBy string, LastUpDt string) (int64, error) {
	con = config.Connection()
	query := "UPDATE tbldocumentdtl set description = ?, status = ?, lastupby = ?, lastupdt = ? where docno = ? && menucode = ?"

	stmt, err := con.Prepare(query)

	if err != nil {
		fmt.Println(err)
	}

	result, err2 := stmt.Exec(Description, Status,  LastUpBy, LastUpDt, Docno, MenuCode)

	if err2 != nil {
		fmt.Println(err2)
	}

	query2 := "UPDATE tbldocumenthdr set lastupby = ?, lastupdt = ? where docno = ? "

	stmt2, err3 := con.Prepare(query2)

	if err3 != nil {
		fmt.Println(err3)
	}

	_, err4 := stmt2.Exec(LastUpBy, LastUpDt, Docno)

	if err4 != nil {
		fmt.Println(err4)
	}

	return result.RowsAffected()
}
// function untuk edit doc header
func EditDocHdr(con *sql.DB, Docno string, Status string,  LastUpBy string, LastUpDt string) (int64, error) {
	con = config.Connection()
	query := "UPDATE tbldocumenthdr set status = ?, lastupby = ?, lastupdt = ? where docno = ? "

	stmt, err := con.Prepare(query)

	if err != nil {
		fmt.Println(err)
	}

	result, err2 := stmt.Exec(Status,  LastUpBy, LastUpDt, Docno)

	if err2 != nil {
		fmt.Println(err2)
	}

	return result.RowsAffected()
}

// Generate docno
func GenerateCode(c *CustomContext) GenerateCodes{
	modulcode := c.Param("modulcode")
	connection = config.Connection()
	query := "SELECT MAX(LEFT(tbldocumenthdr.Docno,4)) AS DocNo FROM tbldocumenthdr WHERE modulcode = ? ORDER BY DocNo DESC"
	
	rows, err := connection.Query(query, modulcode)
	if err != nil {
		fmt.Println(err)
	}
	defer rows.Close()
	result := GenerateCodes{}
	for rows.Next(){
		eror := rows.Scan(&result.DocNo)
		if eror != nil {
			fmt.Println(eror)
		}
	}
	fmt.Println(result.DocNo)
	return result
}
// function untuk mengambil data dari tabel document dtl
func GetDocumentDtl(c *CustomContext) DocumentsDtl {
	docno := c.FormValue("docno")
	menucode := c.FormValue("menucode")
	connection = config.Connection()
	query2 := "SELECT * FROM tbldocumentdtl where docno = ? AND menucode = ? "
	rows2, err2 := connection.Query(query2, docno, menucode)
	if err2 != nil{
		fmt.Println(err2)
	}
	defer rows2.Close()
	result := DocumentsDtl{}

	for rows2.Next() {
		docdtl := DocDtl{}

		eror := rows2.Scan(&docdtl.Docno, &docdtl.MenuCode, &docdtl.Description, &docdtl.Status, &docdtl.CreateBy, &docdtl.CreateDt, &docdtl.LastUpBy, &docdtl.LastUpDt)
		if eror != nil {
			fmt.Println(eror)
		}
		result.DocumentsDtl = append(result.DocumentsDtl, docdtl)
	}
	return result
}
// function untuk mengambil data dari tabel document dtl
func GetDocumentsDtl(c *CustomContext) DocumentsDtlJoin {
	docno := c.FormValue("docno")
	modulcode := c.FormValue("modulcode")
	connection = config.Connection()
	query2 := "SELECT A.Docno, A.MenuCode, B.ModulCode, B.MenuDesc, B.Parent, A.`Status` FROM tbldocumentdtl A LEFT JOIN tblmodulmenu B ON B.MenuCode = A.MenuCode WHERE Docno = ? &&  ModulCode = ?"
	rows2, err2 := connection.Query(query2, docno, modulcode)
	if err2 != nil{
		fmt.Println(err2)
	}
	defer rows2.Close()
	result := DocumentsDtlJoin{}

	for rows2.Next() {
		docdtl := DocDtlJoin{}

		eror := rows2.Scan(&docdtl.Docno, &docdtl.MenuCode, &docdtl.ModulCode, &docdtl.MenuDesc, &docdtl.Parent, &docdtl.Status)
		if eror != nil {
			fmt.Println(eror)
		}
		result.DocumentsDtlJoin = append(result.DocumentsDtlJoin, docdtl)
	}
	return result
}
func GetDocumentsDtlPrint(c *CustomContext) DocumentsDtlJoinPrint {
	docno := c.FormValue("docno")
	modulcode := c.FormValue("modulcode")
	connection = config.Connection()
	query2 := "SELECT A.Docno, A.MenuCode, A.Description, B.ModulCode, B.MenuDesc, B.Parent, A.`Status` FROM tbldocumentdtl A LEFT JOIN tblmodulmenu B ON B.MenuCode = A.MenuCode WHERE Docno = ? &&  ModulCode = ?"
	rows2, err2 := connection.Query(query2, docno, modulcode)
	if err2 != nil{
		fmt.Println(err2)
	}
	defer rows2.Close()
	result := DocumentsDtlJoinPrint{}

	for rows2.Next() {
		docdtl := DocDtlJoinPrint{}

		eror := rows2.Scan(&docdtl.Docno, &docdtl.MenuCode, &docdtl.Description, &docdtl.ModulCode, &docdtl.MenuDesc, &docdtl.Parent, &docdtl.Status)
		if eror != nil {
			fmt.Println(eror)
		}
		result.DocumentsDtlJoinPrint = append(result.DocumentsDtlJoinPrint, docdtl)
	}
	return result
}

// func get data documentdetail by docno and GrpCode join on tblgroupmenu
func GetDocumentDtlById(c *CustomContext) DocumentsDtl {
	connection := config.Connection()
	docno	:= c.FormValue("docno")
	grpcode	:= c.FormValue("grpcode")
	query	:= "SELECT A.* FROM tbldocumentdtl A JOIN tblgroupmenu B ON B.MenuCode = A.MenuCode WHERE A.Docno = ? AND B.GrpCode = ?"
	rows, eror := connection.Query(query, docno, grpcode)

	if eror != nil {
		panic(eror)
	}

	defer rows.Close()

	result := DocumentsDtl{}

	for rows.Next(){
		docdtl := DocDtl{}

		eror := rows.Scan(&docdtl.Docno, &docdtl.MenuCode, &docdtl.Description, &docdtl.Status, &docdtl.CreateBy, &docdtl.CreateDt, &docdtl.LastUpBy, &docdtl.LastUpDt)
		if eror != nil {
			fmt.Println(eror)
		}
		result.DocumentsDtl = append(result.DocumentsDtl, docdtl)
	}
	return result
}
