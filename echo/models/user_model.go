package models

import (
	"database/sql"
	"echo/config"
	"fmt"
)

type User struct {
	UserCode         string `json:"usercode"`
	Username         string `json:"username"`
	GrpCode          string `json:"grpcode"`
	Pwd              string `json:"pwd"`
	ExpDate          string `json:"expdt"`
	NotifyInd        string `json:"notifyind"`
	HasQiscusAccount string `json:"hasqiscusaccout"`
	AvatarImage      string `json:"avatarimage"`
	DeviceId         string `json:"deviceid"`
	CreateBy         string `json:"createby"`
	CreateAt         string `json:"createat"`
	LastupBy         string `json:"lastupby"`
	LastupDt         string `json:"lastupdt"`
}
type PG struct {
	PGCode      string `json:"pgcode"`
	PGName      string `json:"pgname"`
	ActInd      string `json:"actind"`
	ProjectCode string `json:"projectcode"`
	ProjectName string `json:"projectname"`
	CtCode      string `json:"ctcode"`
}

type PGs struct {
	PGs []PG `json:"pg"`
}
type Users struct {
	Users []User `json:"user"`
}

var conn *sql.DB

func GetUser() Users {
	conn := config.Connection()
	queryStatement := "Select usercode, username, grpcode, pwd, expdt, notifyind, hasqiscusaccount, avatarimage, deviceid, createby, createat,lastupby, lastupdt From tbluser"

	rows, err := conn.Query(queryStatement)
	fmt.Println("ROWS : ", rows)
	fmt.Println(err)
	if err != nil {
		fmt.Println(err)
	}
	defer rows.Close()
	result := Users{}

	for rows.Next() {
		user := User{}

		er := rows.Scan(&user.UserCode, &user.Username, &user.GrpCode,
			&user.Pwd, &user.ExpDate, &user.NotifyInd, &user.HasQiscusAccount, &user.AvatarImage, &user.DeviceId,
			&user.CreateBy, &user.CreateAt, &user.LastupBy, &user.LastupDt)
		if er != nil {
			fmt.Println("ER : ", er)
			fmt.Println("err2")
		}
		result.Users = append(result.Users, user)
	}
	return result
}
func GetProjectGroup() PGs {
	conn := config.Connection()
	queryStatement := "Select pgcode, pgname, actind, projectCode, projectname, ctcode From tblprojectgroup"

	rows, err := conn.Query(queryStatement)
	fmt.Println("ROWS : ", rows)
	fmt.Println(err)
	if err != nil {
		fmt.Println(err)
	}
	defer rows.Close()
	result := PGs{}

	for rows.Next() {
		pg := PG{}

		er := rows.Scan(&pg.PGCode, &pg.PGName, &pg.ActInd,
			&pg.ProjectCode, &pg.ProjectName, &pg.CtCode)
		if er != nil {
			fmt.Println("ER : ", er)
			fmt.Println("err2")
		}
		result.PGs = append(result.PGs, pg)
	}
	var data = result.PGs[0]
	fmt.Println("Panjang : ", len(result.PGs))
	fmt.Println("Hasil : ", data.PGCode)
	return result
}
