package models

import (
	"database/sql"
	"echo/config"
	"fmt"

	"github.com/labstack/echo/v4"
	nullable "gopkg.in/guregu/null.v3"
)

type CustomContext struct {
	echo.Context
}

type Rmodule struct {
	MenuCode string          `json:"menucode"`
	MenuDesc string          `json:"menudesc"`
	Parent   nullable.String `json:"parent"`
	Param    nullable.String `json:"param"`
	Icon     nullable.String `json:"icon"`
	StdInd   string          `json:"stdind"`
	SpcInd   string          `json:"spcind"`
	Visible  string          `json:"visible"`
	MenuCat  string          `json:"menucat"`
	CreateBy string          `json:"createby"`
	CreateDt string          `json:"createdt"`
	LastupBy nullable.String `json:"lastupby"`
	LastupDt nullable.String `json:"lastupdt"`
}
type Submodule struct {
	MenuCode string          `json:"menucode"`
	MenuDesc string          `json:"menudesc"`
	Parent   nullable.String `json:"parent"`
	Param    nullable.String `json:"param"`
	Icon     nullable.String `json:"icon"`
	StdInd   string          `json:"stdind"`
	SpcInd   string          `json:"spcind"`
	Visible  string          `json:"visible"`
	MenuCat  string          `json:"menucat"`
	CreateBy string          `json:"createby"`
	CreateDt string          `json:"createdt"`
	LastupBy nullable.String `json:"lastupby"`
	LastupDt nullable.String `json:"lastupdt"`
}
type Subsubmodule struct {
	MenuCode string          `json:"menucode"`
	MenuDesc string          `json:"menudesc"`
	Parent   nullable.String `json:"parent"`
	Param    nullable.String `json:"param"`
	Icon     nullable.String `json:"icon"`
	StdInd   string          `json:"stdind"`
	SpcInd   string          `json:"spcind"`
	Visible  string          `json:"visible"`
	MenuCat  string          `json:"menucat"`
	CreateBy string          `json:"createby"`
	CreateDt string          `json:"createdt"`
	LastupBy nullable.String `json:"lastupby"`
	LastupDt nullable.String `json:"lastupdt"`
}

type Datasubmodule struct {
	Parent   nullable.String `json:"parent"`
	Param    nullable.String `json:"param"`
	Icon     nullable.String `json:"icon"`
	LastupBy nullable.String `json:"lastupby"`
	LastupDt nullable.String `json:"lastupdt"`
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
type Datasubmodules struct {
	Datasubmodules []Datasubmodule `json:"datasubmodule"`
}

var connection *sql.DB

func GetRootModules() Rmodules {
	connection = config.Connection()
	query := "SELECT MenuCode, MenuDesc, Parent, Param, Icon, StdInd, SpcInd, Visible, MenuCat, CreateBy, CreateDt, LastUpBy, LastUpDt FROM tblmenu WHERE parent IS NULL "
	rows, err := connection.Query(query)
	if err != nil {
		fmt.Println(err)
	}
	defer rows.Close()
	result := Rmodules{}

	for rows.Next() {
		rmodule := Rmodule{}

		eror := rows.Scan(&rmodule.MenuCode, &rmodule.MenuDesc, &rmodule.Parent, &rmodule.Param, &rmodule.Icon, &rmodule.StdInd, &rmodule.SpcInd, &rmodule.Visible, &rmodule.MenuCat, &rmodule.CreateBy, &rmodule.CreateDt, &rmodule.LastupBy, &rmodule.LastupDt)
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

func SaveDataSubModules(c *CustomContext) Datasubmodules {
	menucode := c.FormValue("menucode")
	parent := c.FormValue("parent")
	param := c.FormValue("param")
	icon := c.FormValue("icon")
	lastupby := c.FormValue("lastupby")
	lastupdt := c.FormValue("lastupdt")
	connection := config.Connection()
	query := "UPDATE tblmenu SET parent = " + parent + ", param = " + param + ", icon = " + icon + ", lastupBy = " + lastupby + ", lastupDt = " + lastupdt + " WHERE menucode = " + menucode
	rows, eror := connection.Query(query)
	if eror != nil {
		fmt.Println(eror)
	}
	defer rows.Close()
	result := Datasubmodules{}

	if rows.Next() {
		datasubmodule := Datasubmodule{}
		eror2 := rows.Scan(&datasubmodule.Parent, &datasubmodule.Param,
			&datasubmodule.Icon, &datasubmodule.LastupBy, &datasubmodule.LastupDt)
		if eror2 != nil {
			fmt.Println(eror2)
		}
		result.Datasubmodules = append(result.Datasubmodules, datasubmodule)
	}
	return result
}
