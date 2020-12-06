package models

import (
	_"database/sql"
	"echo/config"
	"fmt"

	_"github.com/labstack/echo/v4"
	nullable "gopkg.in/guregu/null.v3"
)

type Group struct {
	GrpCode 		string          `json:"grpcode"`
	GrpName 		string          `json:"grpname"`
	CreateBy 		string          `json:"createby"`
	CreateDt 		string          `json:"createdt"`
	LastupBy 		nullable.String `json:"lastupby"`
	LastupDt 		nullable.String `json:"lastupdt"`
}
type ActionGroup struct {
	GrpCode 		string          `json:"grpcode"`
	GrpName 		string          `json:"grpname"`
	CreateBy 		string          `json:"createby"`
	CreateDt 		string          `json:"createdt"`
	LastupBy 		string 		 `json:"lastupby"`
	LastupDt 		string 		 `json:"lastupdt"`
}

type Groups struct {
	Groups []Group `json:"group"`
}
type GroupMenu struct {
	MenuCode 		string          `json:"menucode"`
	MenuDesc 		string          `json:"menudesc"`
	GrpCode 		string          `json:"grpcode"`
	GrpName 		string          `json:"grpname"`
	AccessInd 	string          `json:"accessind"`
	CreateBy 		string          `json:"createby"`
	CreateDt 		string          `json:"createdt"`
	LastupBy 		nullable.String `json:"lastupby"`
	LastupDt 		nullable.String `json:"lastupdt"`
}
type ActionGroupMenu struct {
	MenuCode 		string          `json:"menucode"`
	GrpCode 		string          `json:"grpcode"`
	AccessInd 	string          `json:"accessind"`
	CreateBy 		string          `json:"createby"`
	CreateDt 		string          `json:"createdt"`
	LastupBy 		nullable.String `json:"lastupby"`
	LastupDt 		nullable.String `json:"lastupdt"`
}

type GroupMenus struct {
	GroupMenus []GroupMenu `json:"groupmenu"`
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
func GetGroupsMenu() GroupMenus {
	connection = config.Connection()
	query1 := "SELECT A.MenuCode, B.MenuDesc, A.GrpCode, C.GrpName, A.AccessInd, A.CreateBy, A.CreateDt, A.LastUpBy, A.LastUpDt FROM tblgroupmenu A LEFT JOIN tblmodulmenu B ON B.MenuCode = A.MenuCode LEFT JOIN tblgroup C ON C.GrpCode = A.GrpCode"
	rows1, err1 := connection.Query(query1)
	if err1 != nil {
		fmt.Println(err1)
	}
	defer rows1.Close()
	result := GroupMenus{}

	for rows1.Next() {
		groupmenu := GroupMenu{}

		eror := rows1.Scan(&groupmenu.MenuCode, &groupmenu.MenuDesc,&groupmenu.GrpCode, &groupmenu.GrpName, &groupmenu.AccessInd, &groupmenu.CreateBy, &groupmenu.CreateDt, &groupmenu.LastupBy, &groupmenu.LastupDt)
		if eror != nil {
			fmt.Println(eror)
		}
		result.GroupMenus = append(result.GroupMenus, groupmenu)
	}
	return result
}
func GetGroupsMenuById(c *CustomContext) GroupMenus {
	menucode 	:= c.FormValue("menucode")
	grpcode 	:= c.FormValue("grpcode")
	connection = config.Connection()
	query1 := "SELECT A.MenuCode, B.MenuDesc, A.GrpCode, C.GrpName, A.AccessInd, A.CreateBy, A.CreateDt, A.LastUpBy, A.LastUpDt FROM tblgroupmenu A LEFT JOIN tblmodulmenu B ON B.MenuCode = A.MenuCode LEFT JOIN tblgroup C ON C.GrpCode = A.GrpCode WHERE A.MenuCode = ? && A.GrpCode = ?"
	rows1, err1 := connection.Query(query1, menucode, grpcode)
	if err1 != nil {
		fmt.Println(err1)
	}
	defer rows1.Close()
	result := GroupMenus{}

	for rows1.Next() {
		groupmenu := GroupMenu{}

		eror := rows1.Scan(&groupmenu.MenuCode, &groupmenu.MenuDesc,&groupmenu.GrpCode, &groupmenu.GrpName, &groupmenu.AccessInd, &groupmenu.CreateBy, &groupmenu.CreateDt, &groupmenu.LastupBy, &groupmenu.LastupDt)
		if eror != nil {
			fmt.Println(eror)
		}
		result.GroupMenus = append(result.GroupMenus, groupmenu)
	}
	return result
}