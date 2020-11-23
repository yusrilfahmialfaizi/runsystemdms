package models

import (
	"database/sql"
	"echo/config"
	"encoding/json"
	"fmt"
	"log"

	nullable "gopkg.in/guregu/null.v3"
)

type User struct {
	UserCode         string          `json:"usercode"`
	Username         string          `json:"username"`
	GrpCode          string          `json:"grpcode"`
	Pwd              string          `json:"pwd"`
	ExpDate          nullable.String `json:"expdt"`
	NotifyInd        string          `json:"notifyind"`
	HasQiscusAccount nullable.String `json:"hasqiscusaccout"`
	AvatarImage      nullable.String `json:"avatarimage"`
	DeviceId         nullable.String `json:"deviceid"`
	CreateBy         string          `json:"createby"`
	CreateDt         string          `json:"createdt"`
	LastupBy         nullable.String `json:"lastupby"`
	LastupDt         nullable.String `json:"lastupdt"`
}
type PG struct {
	PGCode      string          `json:"pgcode"`
	PGName      string          `json:"pgname"`
	ActInd      string          `json:"actind"`
	ProjectCode nullable.String `json:"projectcode"`
	ProjectName nullable.String `json:"projectname"`
	CtCode      nullable.String `json:"ctcode"`
	CreateBy    string          `json:"createby"`
	CreateDt    string          `json:"createdt"`
	LastupBy    nullable.String `json:"lastupby"`
	LastupDt    nullable.String `json:"lastupdt"`
}

type PGs struct {
	PGs []PG `json:"pg"`
}
type Users struct {
	Users []User `json:"user"`
}
type NullString struct {
	sql.NullString
}

var conn *sql.DB

func (ns *NullString) MarshalJSON() ([]byte, error) {
	if !ns.Valid {
		return []byte("null"), nil
	}
	return json.Marshal(ns.String)
}

func GetUser() Users {
	conn := config.Connection()
	queryStatement := "Select usercode, username, grpcode, pwd, expdt, notifyind, hasqiscusaccount, avatarimage, deviceid, createby, createdt,lastupby, lastupdt From tbluser"

	rows, err := conn.Query(queryStatement)
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
			&user.CreateBy, &user.CreateDt, &user.LastupBy, &user.LastupDt)
		if er != nil {
			fmt.Println("ER : ", er)
		}
		userJSON, err := json.Marshal(&user)
		if err != nil {
			log.Fatal(err)
		} else {
			log.Printf("json marshal := %s\n\n", userJSON)
		}
		result.Users = append(result.Users, user)
	}
	return result
}
func GetProjectGroup() PGs {
	conn := config.Connection()
	queryStatement := "Select pgcode, pgname, actind, projectCode, projectname, ctcode, createby, createdt,lastupby, lastupdt From tblprojectgroup Where actind = 'Y'"

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
			&pg.ProjectCode, &pg.ProjectName, &pg.CtCode, &pg.CreateBy, &pg.CreateDt, &pg.LastupBy, &pg.LastupDt)
		if er != nil {
			fmt.Println("ER : ", er)
		}
		result.PGs = append(result.PGs, pg)
	}
	return result
}
