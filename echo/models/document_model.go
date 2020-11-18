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
type UpDatadocumentHdr struct {
	Docno       string          `json:"docno"`
	Status      string          `json:"status"`
	LastUpBy    string 		   `json:"lastupby"`
	LastUpDt    string    	   `json:"lastupdt"`
}
type DocDtl struct {
	Docno       string          `json:"docno"`
	MenuCode    string          `json:"menucode"`
	Description string 		   `json:"description"`
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
	Description nullable.String `json:"description"`
	Status      string          `json:"status"`
	CreateBy    string          `json:"createby"`
	CreateDt    string          `json:"createdt"`
	LastUpBy    nullable.String `json:"lastupby"`
	LastUpDt    nullable.String `json:"lastupdt"`
}

type DocumentsDtl struct {
	DocumentsDtl []DocDtl `json:"documentsdtl"`
}
type DocumentsDtlJoin struct {
	DocumentsDtlJoin []DocDtlJoin `json:"documentsdtl"`
}
type Datadocuments struct {
	Datadocuments []Datadocument `json:"datadocument"`
}
type InsDatadocuments struct {
	InsDatadocuments []InsDatadocument `json:"insdatadocument"`
}
type GenerateCodes struct {
	DocNo int `json:"docno"`
}

var con *sql.DB

//function untuk get document yang ditampilkan di view tabel
func GetDatadocuments() Datadocuments {
	con = config.Connection()
	query := "SELECT tbldocumenthdr.Docno, tbldocumenthdr.ModulCode, tblmodul.ModulName, tbldocumenthdr.ActiveInd, tbldocumenthdr.`Status`, tbldocumenthdr.CreateBy, tbldocumenthdr.CreateDt, tbldocumenthdr.LastUpBy, tbldocumenthdr.LastUpDt FROM tbldocumenthdr INNER JOIN tblmodul ON tblmodul.ModulCode = tbldocumenthdr.ModulCode ORDER BY tbldocumenthdr.CreateDt DESC"
	rows, err := con.Query(query)
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

//function untuk untuk post data documenthdr yang ditampilkan di view tabel
func PostDataDocuments(con *sql.DB, Docno string, ModulCode string, Status string, ActiveInd string, CreateBy string, CreateDt string, LastUpBy string, LastUpDt string) (int64, error) {
	con = config.Connection()
	query1 := "UPDATE tbldocumenthdr SET ActiveInd = 'N' WHERE modulcode = ?"
	query2 := "INSERT INTO tbldocumenthdr (docno, modulcode, activeind, status, createby, createdt, lastupby, lastupdt) values (?,?,?,?,?,?,?,?)"
	query3 := "SELECT tblmodulmenu.MenuCode, tblmodulmenu.ModulCode, tblmodulmenu.MenuDesc, tblmodulmenu.Parent, tblmodulmenu.CreateBy, tblmodulmenu.CreateDt, tblmodulmenu.LastUpBy, tblmodulmenu.LastUpDt, tbldocumentdtl.`Status` FROM tblmodulmenu LEFT JOIN tbldocumentdtl ON tbldocumentdtl.MenuCode = tblmodulmenu.MenuCode WHERE modulcode = ?"
	// Create a prepared SQL statement
	stmt1, err1 := con.Prepare(query1)
	stmt2, err2 := con.Prepare(query2)
	stmt3, err3 := con.Query(query3, ModulCode)

	// / Exit if we get an error
	if err1 != nil && err2 != nil && err3 != nil{
		fmt.Println(err1, err2, err3)
	}
	// Make sure to cleanup after the program exits
	defer stmt1.Close()
	defer stmt2.Close()
	defer stmt3.Close()

	//The sql stat wll return the id, so we can use it.
	_, er1 := stmt1.Exec(ModulCode)
	result, er2 := stmt2.Exec(Docno, ModulCode, ActiveInd, Status, CreateBy, CreateDt, LastUpBy, LastUpDt)

	for stmt3.Next() {
		modulmenu := ModulMenu{}

		er3 := stmt3.Scan(&modulmenu.MenuCode, &modulmenu.ModulCode, &modulmenu.MenuDesc, &modulmenu.Parent, &modulmenu.CreateBy, &modulmenu.CreateDt, &modulmenu.LastupBy, &modulmenu.LastupDt, &modulmenu.Status)
		if er3 != nil {
			fmt.Println(er3)
		}
		fmt.Println(modulmenu.MenuCode, modulmenu.Parent)
		PostDataDocumentsDtl(con, Docno, modulmenu.MenuCode, CreateBy, CreateDt, LastUpBy, LastUpDt)
	}

	// Exit if we get an error
	if er1 != nil && er2 != nil {
		fmt.Println(er1, er2)
	}

	return result.RowsAffected()
	// return result2.RowsAffected()
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
		panic(err)
	}

	result, err2 := stmt.Exec(Description, Status,  LastUpBy, LastUpDt, Docno, MenuCode)

	if err2 != nil {
		panic(err2)
	}

	return result.RowsAffected()
}
// function untuk edit doc header
func EditDocHdr(con *sql.DB, Docno string, Status string,  LastUpBy string, LastUpDt string) (int64, error) {
	con = config.Connection()
	query := "UPDATE tbldocumenthdr set status = ?, lastupby = ?, lastupdt = ? where docno = ? "

	stmt, err := con.Prepare(query)

	if err != nil {
		panic(err)
	}

	result, err2 := stmt.Exec(Status,  LastUpBy, LastUpDt, Docno)

	if err2 != nil {
		panic(err2)
	}

	return result.RowsAffected()
}

// Generate docno
func GenerateCode (c *CustomContext) GenerateCodes{
	modulcode := c.Param("modulcode")
	con = config.Connection()
	// query := "SELECT MAX(LEFT(tbldocumenthdr.Docno,4)) AS DocNo FROM tbldocumenthdr ORDER BY DocNo DESC"
	query := "SELECT MAX(LEFT(tbldocumenthdr.Docno,4)) AS DocNo FROM tbldocumenthdr WHERE modulcode = ? ORDER BY DocNo DESC"
	
	rows, err := con.Query(query, modulcode)
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
	query2 := "SELECT tbldocumentdtl.Docno, tblmodulmenu.MenuCode, tblmodulmenu.ModulCode, tblmodulmenu.MenuDesc, tblmodulmenu.Parent, tbldocumentdtl.Description, tbldocumentdtl.`Status`,tblmodulmenu.CreateBy, tblmodulmenu.CreateDt, tblmodulmenu.LastUpBy, tblmodulmenu.LastUpDt FROM tblmodulmenu LEFT JOIN tbldocumentdtl ON tbldocumentdtl.MenuCode = tblmodulmenu.MenuCode WHERE Docno = ? &&  ModulCode = ?"
	rows2, err2 := connection.Query(query2, docno, modulcode)
	if err2 != nil{
		fmt.Println(err2)
	}
	defer rows2.Close()
	result := DocumentsDtlJoin{}

	for rows2.Next() {
		docdtl := DocDtlJoin{}

		eror := rows2.Scan(&docdtl.Docno, &docdtl.MenuCode, &docdtl.ModulCode, &docdtl.MenuDesc, &docdtl.Parent, &docdtl.Description, &docdtl.Status, &docdtl.CreateBy, &docdtl.CreateDt, &docdtl.LastUpBy, &docdtl.LastUpDt)
		if eror != nil {
			fmt.Println(eror)
		}
		result.DocumentsDtlJoin = append(result.DocumentsDtlJoin, docdtl)
	}
	return result
}
