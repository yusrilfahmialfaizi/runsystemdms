package models

import (
	"database/sql"
	"echo/config"
	"fmt"

	nullable "gopkg.in/guregu/null.v3"
)

type Datadocument struct {
	Docno       string          `json:"docno"`
	Description nullable.String `json:"description"`
	Status      string          `json:"status"`
	ActiveInd   string          `json:"activeind"`
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

var con *sql.DB

//function untuk get document yang ditampilkan di view tabel
func GetDatadocuments() Datadocuments {
	con = config.Connection()
	query := "SELECT hdr.docno as docno, dtl.description as description, hdr.status as status, hdr.activeind as activeind, hdr.createby as createby, hdr.createdt as createdt, hdr.lastupby as lastupby, hdr.lastupdt as lastupdt FROM tbldocumenthdr as hdr JOIN tbldocumentdtl as dtl ON dtl.docno = hdr.docno"
	rows, err := con.Query(query)
	if err != nil {
		fmt.Println(err)
	}
	defer rows.Close()
	result := Datadocuments{}

	for rows.Next() {
		datadocument := Datadocument{}

		eror := rows.Scan(&datadocument.Docno, &datadocument.Description, &datadocument.Status, &datadocument.ActiveInd, &datadocument.CreateBy, &datadocument.CreateDt, &datadocument.LastupBy, &datadocument.LastupDt)
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
	query := "INSERT INTO tbldocumenthdr (docno, modulcode, activeind, status, createby, createdt, lastupby, lastupdt) values (?,?,?,?,?,?,?,?)"
	// Create a prepared SQL statement
	stmt, err := con.Prepare(query)

	// / Exit if we get an error
	if err != nil {
		panic(err)
	}
	// Make sure to cleanup after the program exits
	defer stmt.Close()

	//The sql stat wll return the id, so we can use it.
	result, err2 := stmt.Exec(Docno, ModulCode, ActiveInd, Status, CreateBy, CreateDt, LastUpBy, LastUpDt)

	// Exit if we get an error
	if err2 != nil {
		panic(err2)
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

	// if err := c.Bind(stmt); err !=nil {
	// 			return err
	// }
	// / Exit if we get an error
	if err != nil {
		panic(err)
	}
	// Make sure to cleanup after the program exits
	defer stmt.Close()

	//The sql stat wll return the id, so we can use it.
	result, err2 := stmt.Exec(Docno, MenuCode, Description, Status, CreateBy, CreateDt, LastUpBy, LastUpDt)

	// data := map[string]result, result2

	// data := [result, result2]

	// Exit if we get an error
	if err2 != nil {
		panic(err2)
	}
	// if err3 != nil {
	// 	panic(err3)
	// }

	return result.RowsAffected()
	// return result2.RowsAffected()
}

// func PostDataDocuments(c *CustomContext) InDatadocuments {
// 	// form := map[string]string{
// 	// 	"docno":     c.FormValue("docno"),
// 	// 	"modulcode": c.FormValue("modulcode")
// 	// 	"activeind": c.FormValue("activeind")
// 	// 	"status":    c.FormValue("status"),
// 	// 	"createby":  c.FormValue("createby"),
// 	// 	createdt":  c.FormValue("createdt"),
// // 	// 	"lastupby":  c.FormValue("lastupby"),
// 	// 	"lastupdt":  c.FormVaue("lastupdt"),
// 	// }

// 	con = config.Conection()
// 	query := "INSERT NTO tbldocumenthdr (docno, modulcode, activeind, status, createby, createdt, lastupby, lastupdt) values ()"
// 	rws, err := con.Query(query)
// 	if err != nil {
// 		fmt.Println(err)
// 	}
// 	defer rows.Close(
// 	result := InsDatadocuments{}

// 	for rows.Next() {
// 		datadocument := InsDatadocument{}
// 		// eror := rows.can(&datadocument.Docno1, &datadocument.Docno2, &datadocument.MenuCode, &datadocument.ModulCode, &datadocument.Description, &datadocument.Status1, &datadocument.Status2, &datadocument.ActiveInd, &datadocument.CreateBy1, &datadocument.CreateDt1, &datadocument.LastupBy1, &datadocument.LastupDt1, &datadocument.CreateBy2, &datadocument.CreateDt2, &datadocument.LastupBy2, &datadocument.LastupDt2)

// 		eor := rows.Scan(&datadocument.Docno, &datadocument.ModulCode, &datadocument.ActiveInd, &datadocument.Status, &datadocument.CreateBy, &datadocument.CreateDt, &datadocument.LastupBy, &datadocument.LastupDt)
// 		if eror != nil {
// 		fmt.Println(eror)
// 		}
// 	result.InsDatadocuments = append(result.InsDatadocuments, datadocument)
// 	}
// 	return result
// }
