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
	LastUpBy    nullable.String `json:"lastupby"`
	LastUpDt    nullable.String `json:"lastupdt"`
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
	// query := "SELECT hdr.docno as docno, hdr.modulcode as modulcode, dtl.description as description, hdr.status as status, hdr.activeind as activeind, dtl.menucode as menucode, hdr.createby as createby, hdr.createdt as createdt, hdr.lastupby as lastupby, hdr.lastupdt as lastupdt FROM tbldocumenthdr as hdr JOIN tbldocumentdtl as dtl ON dtl.docno = hdr.docno"
	query := "SELECT * FROM tbldocumenthdr where ActiveInd = 'Y'"
	rows, err := con.Query(query)
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

//function untuk untuk post data documenthdr yang ditampilkan di view tabel
func PostDataDocuments(con *sql.DB, Docno string, ModulCode string, Status string, ActiveInd string, CreateBy string, CreateDt string, LastUpBy nullable.String, LastUpDt nullable.String) (int64, error) {
	con = config.Connection()
	query1 := "UPDATE tbldocumenthdr SET ActiveInd = 'N' WHERE modulcode = ?"
	query2 := "INSERT INTO tbldocumenthdr (docno, modulcode, activeind, status, createby, createdt, lastupby, lastupdt) values (?,?,?,?,?,?,?,?)"
	// Create a prepared SQL statement
	stmt1, err1 := con.Prepare(query1)
	stmt2, err2 := con.Prepare(query2)

	// / Exit if we get an error
	if err1 != nil && err2 != nil {
		fmt.Println(err1, err2)
	}
	// Make sure to cleanup after the program exits
	defer stmt1.Close()
	defer stmt2.Close()

	//The sql stat wll return the id, so we can use it.
	_, er1 := stmt1.Exec(ModulCode)
	result, er2 := stmt2.Exec(Docno, ModulCode, ActiveInd, Status, CreateBy, CreateDt, LastUpBy, LastUpDt)

	// Exit if we get an error
	if er2 != nil {
		fmt.Println(er1, er2)
	}

	return result.RowsAffected()
	// return result2.RowsAffected()
}

//function untuk untuk post data documentdtl yang ditampilkan di view tabel
func PostDataDocumentsDtl(con *sql.DB, Docno string, MenuCode string, Description string, Status string, CreateBy string, CreateDt string, LastUpBy nullable.String, LastUpDt nullable.String) (int64, error) {
	con = config.Connection()
	query := "INSERT INTO tbldocumentdtl (docno, menucode, description, status, createby, createdt, lastupby, lastupdt) values (?,?,?,?,?,?,?,?)"
	// Create a prepared SQL statement
	stmt, err := con.Prepare(query)

	// / Exit if we get an error
	if err != nil {
		panic(err)
	}
	// Make sure to cleanup after the program exits
	defer stmt.Close()

	//The sql stat wll return the id, so we can use it.
	result, err2 := stmt.Exec(Docno, MenuCode, Description, Status, CreateBy, CreateDt, LastUpBy, LastUpDt, Docno)

	// Exit if we get an error
	if err2 != nil {
		panic(err2)
	}

	return result.RowsAffected()
}

//function untuk untuk edit data documenthdr yang ditampilkan di view tabel
func EditDocHdr(con *sql.DB, Docno string, ModulCode string, ActiveInd string, Status string, CreateBy string, CreateDt string, LastUpBy nullable.String, LastUpDt nullable.String) (int64, error) {
	con = config.Connection()
	query := "Update tbldocumenthdr set modulcode = ?, activeind = ?, status = ?, createby = ?, createdt = ?, lastupby = ?, lastupdt = ? where docno = ?"

	stmt, err := con.Prepare(query)

	if err != nil {
		panic(err)
	}

	result, err2 := stmt.Exec(ModulCode, ActiveInd, Status, CreateBy, CreateDt, LastUpBy, LastUpDt, Docno)

	if err2 != nil {
		panic(err2)
	}

	return result.RowsAffected()
}

//function untuk untuk edit data documenthdr yang ditampilkan di view tabel
func EditDocDtl(con *sql.DB, Docno string, MenuCode string, Description string, Status string, CreateBy string, CreateDt string, LastUpBy nullable.String, LastUpDt nullable.String) (int64, error) {
	con = config.Connection()
	query := "UPDATE tbldocumentdtl set menucode = ?, description = ?, status = ?, createby = ?, createdt = ?, lastupby = ?, lastupdt = ? where docno = ?"

	stmt, err := con.Prepare(query)

	if err != nil {
		panic(err)
	}

	result, err2 := stmt.Exec(MenuCode, Description, Status, CreateBy, CreateDt, LastUpBy, LastUpDt, Docno)

	if err2 != nil {
		panic(err2)
	}

	return result.RowsAffected()
}

//func untuk delete data tbldocumenthdr dan tbldocumentdtl
func DeleteDocs(c *CustomContext) Datadocuments {
	connection := config.Connection()
	docno := c.FormValue("docno")
	query := "DELETE tbldocumenthdr.*, tbldocumentdtl.* FROM tbldocumenthdr INNER JOIN tbldocumentdtl  WHERE tbldocumenthdr.docno = tbldocumentdtl.docno and tbldocumenthdr.docno = " + docno

	rows, eror := connection.Query(query)
	if eror != nil {
		fmt.Println(eror)
	}
	defer rows.Close()
	result := Datadocuments{}

	if rows.Next() {
		datadocument := Datadocument{}
		eror2 := rows.Scan(&datadocument.Docno)
		if eror2 != nil {
			fmt.Println(eror2)
		}
		result.Datadocuments = append(result.Datadocuments, datadocument)
	}
	return result

	// // buat prepare statement
	// stmt, err := con.Prepare(query)
	// // Exit jika error
	// if err != nil {
	// 	panic(err)
	// }

	// result, err2 := stmt.Exec(docno)
	// // Exit jika error
	// if err2 != nil {
	// 	panic(err2)
	// }

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
