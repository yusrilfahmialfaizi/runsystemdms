package models

import (
	"database/sql"
	"echo/config"
	"fmt"

	"github.com/labstack/echo/v4"
)

type CustomContext struct {
	echo.Context
}

type Rmodule struct {
	MenuCode string `json:"menucode"`
	MenuDesc string `json:"menudesc"`
	Parent   string `json:"parent"`
	Param    string `json:"param"`
	Icon     string `json:"icon"`
	StdInd   string `json:"stdind"`
	SpcInd   string `json:"spcind"`
	Visible  string `json:"visible"`
	MenuCat  string `json:"menucat"`
	CreateBy string `json:"createby"`
	CreateDt string `json:"createdt"`
	LastupBy string `json:"lastupby"`
	LastupDt string `json:"lastupdt"`
}
type Submodule struct {
	MenuCode string `json:"menucode"`
	MenuDesc string `json:"menudesc"`
	Parent   string `json:"parent"`
	Param    string `json:"param"`
	Icon     string `json:"icon"`
	StdInd   string `json:"stdind"`
	SpcInd   string `json:"spcind"`
	Visible  string `json:"visible"`
	MenuCat  string `json:"menucat"`
	CreateBy string `json:"createby"`
	CreateDt string `json:"createdt"`
	LastupBy string `json:"lastupby"`
	LastupDt string `json:"lastupdt"`
}
type Subsubmodule struct {
	MenuCode string `json:"menucode"`
	MenuDesc string `json:"menudesc"`
	Parent   string `json:"parent"`
	Param    string `json:"param"`
	Icon     string `json:"icon"`
	StdInd   string `json:"stdind"`
	SpcInd   string `json:"spcind"`
	Visible  string `json:"visible"`
	MenuCat  string `json:"menucat"`
	CreateBy string `json:"createby"`
	CreateDt string `json:"createdt"`
	LastupBy string `json:"lastupby"`
	LastupDt string `json:"lastupdt"`
}
type Rmodules struct {
	Rmodules []Rmodule `json:"rmodule"`
}
type Submodules struct {
	Submodules []Submodule `json:"submodule"`
}
type Subsubmodules struct {
	Subsubmodules []Subsubmodule `json:"subsubmodule"`
}

var connection *sql.DB

func GetRootModules() Rmodules {
	connection = config.Connection()
	query := "SELECT menucode,menudesc,parent,param,icon,stdind,spcind,visible,menucat,createby,createdt,lastupby,lastupdt FROM tblmenu WHERE parent IS Null"
	rows, err := connection.Query(query)
	if err != nil {
		fmt.Println(err)
	}
	defer rows.Close()
	result := Rmodules{}

	for rows.Next() {
		rmodule := Rmodule{}

		eror := rows.Scan(&rmodule.MenuCode, &rmodule.MenuDesc, &rmodule.Parent, &rmodule.Param,
			&rmodule.Icon, &rmodule.StdInd, &rmodule.SpcInd, &rmodule.Visible, &rmodule.MenuCat,
			&rmodule.CreateBy, &rmodule.CreateDt, &rmodule.LastupBy, &rmodule.LastupDt)
		if eror != nil {
			fmt.Println(eror)
		}
		result.Rmodules = append(result.Rmodules, rmodule)
	}
	return result
}

func GetSubModules(c *CustomContext) Submodules {
	parent := c.FormValue("parent")
	connection := config.Connection()
	query := "SELECT menucode,menudesc,parent,param,icon,stdind,spcind,visible,menucat,createby,createdt,lastupby,lastupdt FROM tblmenu WHERE parent = " + parent
	rows, eror1 := connection.Query(query)
	if eror1 != nil {
		fmt.Println(eror1)
	}
	defer rows.Close()
	result := Submodules{}

	for rows.Next() {
		submodule := Submodule{}
		eror2 := rows.Scan(&submodule.MenuCode, &submodule.MenuDesc, &submodule.Parent, &submodule.Param,
			&submodule.Icon, &submodule.StdInd, &submodule.SpcInd, &submodule.Visible, &submodule.MenuCat,
			&submodule.CreateBy, &submodule.CreateDt, &submodule.LastupBy, &submodule.LastupDt)
		if eror2 != nil {
			fmt.Println(eror2)
		}
		result.Submodules = append(result.Submodules, submodule)
	}
	return result
}
func GetSubsubmodules(c *CustomContext) Subsubmodules {
	parent := c.FormValue("parent")
	connection := config.Connection()
	query := "SELECT menucode,menudesc,parent,param,icon,stdind,spcind,visible,menucat,createby,createdt,lastupby,lastupdt FROM tblmenu WHERE parent = " + parent
	rows, eror1 := connection.Query(query)
	if eror1 != nil {
		fmt.Println(eror1)
	}
	defer rows.Close()
	result := Subsubmodules{}

	for rows.Next() {
		subsubmodule := Subsubmodule{}
		eror2 := rows.Scan(&subsubmodule.MenuCode, &subsubmodule.MenuDesc, &subsubmodule.Parent, &subsubmodule.Param,
			&subsubmodule.Icon, &subsubmodule.StdInd, &subsubmodule.SpcInd, &subsubmodule.Visible, &subsubmodule.MenuCat,
			&subsubmodule.CreateBy, &subsubmodule.CreateDt, &subsubmodule.LastupBy, &subsubmodule.LastupDt)
		if eror2 != nil {
			fmt.Println(eror2)
		}
		result.Subsubmodules = append(result.Subsubmodules, subsubmodule)
	}
	return result
}

// func GetSubsubmodule(c *CustomContext) Subsubmodules {
// 	parent := c.FormValue("parent")
// 	connection := config.Connection()
// 	query := "SELECT menucode,menudesc,parent,param,icon,stdind,spcind,visible,menucat,createby,createdt,lastupby,lastupdt FROM tblmenu WHERE parent = " + parent
// 	rows, eror := connection.Query(query)
// 	if eror != nil {
// 		fmt.Println(eror)
// 	}
// 	defer rows.Close()
// 	result := Subsubmodules{}

// 	if rows.Next() {
// 		subsubmodule := Subsubmodule{}
// 		eror2 := rows.Scan(&subsubmodule.MenuCode, &subsubmodule.MenuDesc, &subsubmodule.Parent, &subsubmodule.Param,
// 			&subsubmodule.Icon, &subsubmodule.StdInd, &subsubmodule.SpcInd, &subsubmodule.Visible, &subsubmodule.MenuCat,
// 			&subsubmodule.CreateBy, &subsubmodule.CreateDt, &subsubmodule.LastupBy, &subsubmodule.LastupDt)
// 		if eror2 != nil {
// 			fmt.Println(eror2)
// 		}
// 		result.Subsubmodules = append(result.Subsubmodules, subsubmodule)
// 	}
// 	return result
// }
