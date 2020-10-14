package config

import (
	"database/sql"
	"fmt"

	_ "github.com/go-sql-driver/mysql"
)

func Connection() *sql.DB {
	db, err := sql.Open("mysql", "root:@tcp(localhost:3307)/apotek")
	if err != nil {
		fmt.Println(err.Error())
	} else {
		fmt.Println("DB is Connected")
	}
	// defer db.Close() //skip apabila terjadi
	// pastikan koneksi tersambung
	err = db.Ping()
	fmt.Println(err)
	if err != nil {
		fmt.Println("DB is not Connected")
		fmt.Println(err.Error())
	}
	return db
}
