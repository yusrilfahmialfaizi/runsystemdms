package models

import (
	_"database/sql"
	"echo/config"
	"fmt"

	_"github.com/labstack/echo/v4"
	nullable "gopkg.in/guregu/null.v3"
)

type Group struct {
	GrpCode 	string          `json:"grpcode"`
	GrpName 	string          `json:"grpname"`
	CreateBy 		string          `json:"createby"`
	CreateDt 		string          `json:"createdt"`
	LastupBy 		nullable.String `json:"lastupby"`
	LastupDt 		nullable.String `json:"lastupdt"`
}

type Groups struct {
	Groups []Group `json:"group"`
}

func GetGroups() Groups {
	connection = config.Connection()
	query1 := "SELECT GrpCode, GrpName, CreateBy, CreateDt, LastUpBy, LastUpDt FROM tblgroup"
	rows1, err1 := connection.Query(query1)
	if err1 != nil {
		fmt.Println(err1)
	}
	defer rows1.Close()
	result := Groups{}

	for rows1.Next() {
		group := Group{}

		eror := rows1.Scan(&group.GrpCode, &group.GrpName, &group.CreateBy, &group.CreateDt, &group.LastupBy, &group.LastupDt)
		if eror != nil {
			fmt.Println(eror)
		}
		result.Groups = append(result.Groups, group)
	}
	return result
}
func GetGroupsById(c *CustomContext) Groups {
	grpcode := c.Param("grpcode")
	connection = config.Connection()
	query1 := "SELECT GrpCode, GrpName, CreateBy, CreateDt, LastUpBy, LastUpDt FROM tblgroup WHERE GrpCode = ?"
	rows1, err1 := connection.Query(query1, grpcode)
	if err1 != nil {
		fmt.Println(err1)
	}
	defer rows1.Close()
	result := Groups{}

	for rows1.Next() {
		group := Group{}

		eror := rows1.Scan(&group.GrpCode, &group.GrpName, &group.CreateBy, &group.CreateDt, &group.LastupBy, &group.LastupDt)
		if eror != nil {
			fmt.Println(eror)
		}
		result.Groups = append(result.Groups, group)
	}
	return result
}
func GetGroupsMenu() Groups {
	connection = config.Connection()
	query1 := "SELECT GrpCode, GrpName, CreateBy, CreateDt, LastUpBy, LastUpDt FROM tblgroup"
	rows1, err1 := connection.Query(query1)
	if err1 != nil {
		fmt.Println(err1)
	}
	defer rows1.Close()
	result := Groups{}

	for rows1.Next() {
		group := Group{}

		eror := rows1.Scan(&group.GrpCode, &group.GrpName, &group.CreateBy, &group.CreateDt, &group.LastupBy, &group.LastupDt)
		if eror != nil {
			fmt.Println(eror)
		}
		result.Groups = append(result.Groups, group)
	}
	return result
}
func GetGroupsMenuById(c *CustomContext) Groups {
	grpcode := c.Param("grpcode")
	connection = config.Connection()
	query1 := "SELECT GrpCode, GrpName, CreateBy, CreateDt, LastUpBy, LastUpDt FROM tblgroup WHERE GrpCode = ?"
	rows1, err1 := connection.Query(query1, grpcode)
	if err1 != nil {
		fmt.Println(err1)
	}
	defer rows1.Close()
	result := Groups{}

	for rows1.Next() {
		group := Group{}

		eror := rows1.Scan(&group.GrpCode, &group.GrpName, &group.CreateBy, &group.CreateDt, &group.LastupBy, &group.LastupDt)
		if eror != nil {
			fmt.Println(eror)
		}
		result.Groups = append(result.Groups, group)
	}
	return result
}