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

type Modul struct {
	ModulCode string          `json:"modulcode"`
	ModulName string          `json:"modulname"`
	CreateBy string          `json:"createby"`
	CreateDt string          `json:"createdt"`
	LastupBy nullable.String `json:"lastupby"`
	LastupDt nullable.String `json:"lastupdt"`
}
type ModulMenu struct {
	MenuCode string          `json:"menucode"`
	ModulCode string          `json:"modulcode"`
	MenuDesc string          `json:"menudesc"`
	Parent   nullable.String `json:"parent"`
	CreateBy string          `json:"createby"`
	CreateDt string          `json:"createdt"`
	LastupBy nullable.String `json:"lastupby"`
	LastupDt nullable.String `json:"lastupdt"`
	Status nullable.String `json:"status"`
}


type Datasubmodule struct {
	Parent   nullable.String `json:"parent"`
	Param    nullable.String `json:"param"`
	Icon     nullable.String `json:"icon"`
	LastupBy nullable.String `json:"lastupby"`
	LastupDt nullable.String `json:"lastupdt"`
}
type ParentLength struct {
	ParentLength nullable.String `json:"parentlength"`
}
type LastChild struct {
	MenuCode string          `json:"menucode"`
	ModulCode string          `json:"modulcode"`
	MenuDesc string          `json:"menudesc"`
	Parent   nullable.String `json:"parent"`
	CreateBy string          `json:"createby"`
	CreateDt string          `json:"createdt"`
	LastupBy nullable.String `json:"lastupby"`
	LastupDt nullable.String `json:"lastupdt"`
}

type Moduls struct {
	Moduls []Modul `json:"modul"`
	ModulMenu []ModulMenu `json:"modulmenu"`
}

type Menu struct {
	Menu []Moduls `json:"menu"`
}

type DynamicMenu struct {
	ParentLengths []ParentLength `json:"parentlength"`
	LastChilds []LastChild `json:"lastChilds"`
}
type Parts struct {
	Parts []DynamicMenu `json:"parts"`
}

type Datasubmodules struct {
	Datasubmodules []Datasubmodule `json:"datasubmodule"`
}

var connection *sql.DB

// function untuk mengambil data dari tabel menu berdasarkan parent yang memiliki 2 digit angka
func GetModuls() Menu {
	connection = config.Connection()
	query1 := "SELECT ModulCode, ModulName, CreateBy, CreateDt, LastUpBy, LastUpDt FROM tblmodul "
	query2 := "SELECT tblmodulmenu.MenuCode, tblmodulmenu.ModulCode, tblmodulmenu.MenuDesc, tblmodulmenu.Parent, tblmodulmenu.CreateBy, tblmodulmenu.CreateDt, tblmodulmenu.LastUpBy, tblmodulmenu.LastUpDt, tbldocumentdtl.`Status` FROM tblmodulmenu LEFT JOIN tbldocumentdtl ON tbldocumentdtl.MenuCode = tblmodulmenu.MenuCode"
	rows1, err1 := connection.Query(query1)
	rows2, err2 := connection.Query(query2)
	if err1 != nil && err2 != nil{
		fmt.Println(err1)
		fmt.Println(err2)
	}
	defer rows1.Close()
	defer rows2.Close()
	all_result := Menu{}
	result := Moduls{}

	for rows1.Next() {
		modul := Modul{}

		eror := rows1.Scan(&modul.ModulCode, &modul.ModulName, &modul.CreateBy, &modul.CreateDt, &modul.LastupBy, &modul.LastupDt)
		if eror != nil {
			fmt.Println(eror)
		}
		result.Moduls = append(result.Moduls, modul)
	}
	for rows2.Next() {
		modulmenu := ModulMenu{}

		eror := rows2.Scan(&modulmenu.MenuCode, &modulmenu.ModulCode, &modulmenu.MenuDesc, &modulmenu.Parent, &modulmenu.CreateBy, &modulmenu.CreateDt, &modulmenu.LastupBy, &modulmenu.LastupDt, &modulmenu.Status)
		if eror != nil {
			fmt.Println(eror)
		}
		result.ModulMenu = append(result.ModulMenu, modulmenu)
	}
	all_result.Menu = append(all_result.Menu, result)
	return all_result
}


// function untuk mengambil panjang data parent dari tabel menu berdasarkan parent
func GetDynamicMenuParts() Parts {
	connection = config.Connection()
	query1 := "SELECT Length(parent) FROM tblmodulmenu GROUP BY Length(parent) "
	query2 := "SELECT  * FROM tblmodulmenu A WHERE NOT EXISTS(SELECT  NULL	FROM    tblmodulmenu B	WHERE   B.parent = A.MenuCode);"
	rows1, err1 := connection.Query(query1)
	rows2, err2 := connection.Query(query2)
	if err1 != nil && err2 != nil{
		fmt.Println(err1, err2)
	}
	defer rows1.Close()
	defer rows2.Close()
	all_result := Parts{}
	result := DynamicMenu{}

	for rows1.Next() {
		parentLength := ParentLength{}

		eror := rows1.Scan(&parentLength.ParentLength)
		if eror != nil {
			fmt.Println(eror)
		}
		result.ParentLengths = append(result.ParentLengths, parentLength)
	}
	for rows2.Next() {
		lastChild := LastChild{}
		eror2 := rows2.Scan(&lastChild.MenuCode, &lastChild.ModulCode, &lastChild.MenuDesc, &lastChild.Parent, &lastChild.CreateBy, &lastChild.CreateDt, &lastChild.LastupBy, &lastChild.LastupDt)
		if eror2 != nil {
			fmt.Println("eror 2 : ", eror2)
		}
		result.LastChilds = append(result.LastChilds, lastChild)
	}
	all_result.Parts = append(all_result.Parts, result)

	return all_result
}


// function update data berdasarkan menucode pada tabel menu
func UpdateDataSubModules(c *CustomContext) Datasubmodules {
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
