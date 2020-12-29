package models

import (
	"database/sql"
	"echo/config"
	"fmt"
)

type Log struct {
	LogCode     string `json:"logcode"`
	Docno       string `json:"docno"`
	CreateBy    string `json:"createby"`
	CreateDt    string `json:"createdt"`
	LastupBy    string `json:"lastupby"`
	LastupDt    string `json:"lastupdt"`
}

type Logs struct {
	Logs []Log `json:"log"`
}

// func get data log by docno
func GetLogById(c *CustomContext) Logs {
	connection 	:= config.Connection()
	// docno		:= c.Param("docno")
	query		:= "SELECT * FROM tbllog ORDER BY LastUpDt DESC"
	rows, eror 	:= connection.Query(query)

	if eror != nil {
		panic(eror)
	}

	defer rows.Close()

	result := Logs{}

	for rows.Next(){
		log := Log{}

		eror := rows.Scan(&log.LogCode,&log.Docno, &log.LastupBy, &log.LastupDt)
		if eror != nil {
			fmt.Println(eror)
		}
		result.Logs = append(result.Logs, log)
	}
	return result
}
//function untuk untuk post data log yang ditampilkan di view tabel
func PostLog(con *sql.DB, Docno string, LastupBy string, LastupDt string) (int64, error) {
	con 			= config.Connection()

	query2 		:= "INSERT INTO tbllog (docno, lastupby, lastupdt) values (?,?,?)"
	stmt2, err2 	:= con.Prepare(query2)

	if err2 != nil {

		fmt.Println(err2)
	}
	defer stmt2.Close()

	result, er2 := stmt2.Exec(Docno, LastupBy, LastupDt)

	if er2 != nil {
		panic(er2)
	}
	return result.RowsAffected()
}