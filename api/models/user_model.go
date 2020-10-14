package models

import (
	"database/sql"
	"echo/config"
	"fmt"
)

type User struct {
	IDUser       string `json:"id_user"`
	NamaUser     string `json:"nama_user"`
	JenisKelamin string `json:"jenis_kelamin"`
	Alamat       string `json:"alamat"`
	Jabatan      string `json:"jabatan"`
	Username     string `json:"username"`
	Password     string `json:"password"`
}

type Users struct {
	Users []User `json:"user"`
}

var conn *sql.DB

func GetUser() Users {
	conn := config.Connection()
	queryStatement := "Select id_user, nama_user, jenis_kelamin,alamat, jabatan, username,password From user"

	rows, err := conn.Query(queryStatement)
	fmt.Println(rows)
	fmt.Println(err)
	if err != nil {
		fmt.Println(err)
		// fmt.Println("err1")
		// w.WriteHeader(http.StatusInternalServerError) // Proper HTTP response
		// return
		// return c.JSON(http.StatusCreated, u)
	}
	defer rows.Close()
	result := Users{}

	for rows.Next() {
		user := User{}

		er := rows.Scan(&user.IDUser, &user.NamaUser, &user.JenisKelamin,
			&user.Alamat, &user.Jabatan, &user.Username, &user.Password)
		if er != nil {
			// fmt.Println(er)
			fmt.Println("err2")
		}
		result.Users = append(result.Users, user)
	}

	return result
}
