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
	ModulCode 	string          `json:"modulcode"`
	ModulName 	string          `json:"modulname"`
	ProjectCode 	string		 `json:"projectcode"`
	CreateBy 		string          `json:"createby"`
	CreateDt 		string          `json:"createdt"`
	LastupBy 		nullable.String `json:"lastupby"`
	LastupDt 		nullable.String `json:"lastupdt"`
}
type ModulMenu struct {
	MenuCode string          `json:"menucode"`
	ModulCode string         `json:"modulcode"`
	MenuDesc string          `json:"menudesc"`
	Parent   nullable.String `json:"parent"`
	CreateBy string          `json:"createby"`
	CreateDt string          `json:"createdt"`
	LastupBy nullable.String `json:"lastupby"`
	LastupDt nullable.String `json:"lastupdt"`
	Status nullable.String   `json:"status"`
}
type MenuAddDocument struct {
	MenuCode string          `json:"menucode"`
	ModulCode string         `json:"modulcode"`
	MenuDesc string          `json:"menudesc"`
	Parent   nullable.String `json:"parent"`
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
type ParentLength struct {
	ParentLength nullable.String `json:"parentlength"`
}
type LastChild struct {
	MenuCode string          `json:"menucode"`
	ModulCode string         `json:"modulcode"`
	MenuDesc string          `json:"menudesc"`
	Parent   nullable.String `json:"parent"`
	CreateBy string          `json:"createby"`
	CreateDt string          `json:"createdt"`
	LastupBy nullable.String `json:"lastupby"`
	LastupDt nullable.String `json:"lastupdt"`
}

type Moduls struct {
	Moduls []Modul `json:"modul"`
}

type Menu struct {
	Menu []ModulMenu `json:"menu"`
}
type Add struct {
	Add []MenuAddDocument `json:"add"`
}

type DynamicMenu struct {
	ParentLengths []ParentLength 	`json:"parentlength"`
	LastChilds    []LastChild 	`json:"lastChilds"`
}
type Parts struct {
	Parts []DynamicMenu `json:"parts"`
}

type Datasubmodules struct {
	Datasubmodules []Datasubmodule `json:"datasubmodule"`
}

var connection *sql.DB

// function untuk mengambil data dari tabel menu berdasarkan parent yang memiliki 2 digit angka
func GetModuls() Moduls {
	connection = config.Connection()
	query1 := "SELECT ModulCode, ModulName, CreateBy, ProjectCode, CreateDt, LastUpBy, LastUpDt FROM tblmodul"
	rows1, err1 := connection.Query(query1)
	if err1 != nil {
		fmt.Println(err1)
		// fmt.Println(err2)
	}
	defer rows1.Close()
	result := Moduls{}

	for rows1.Next() {
		modul := Modul{}

		eror := rows1.Scan(&modul.ModulCode, &modul.ModulName, &modul.ProjectCode, &modul.CreateBy, &modul.CreateDt, &modul.LastupBy, &modul.LastupDt)
		if eror != nil {
			fmt.Println(eror)
		}
		result.Moduls = append(result.Moduls, modul)
	}
	return result
}
func GetModulsWithId(c *CustomContext) Moduls {
	projectcode := c.Param("projectcode");
	connection = config.Connection()
	query1 := "SELECT ModulCode, ModulName, CreateBy, ProjectCode, CreateDt, LastUpBy, LastUpDt FROM tblmodul WHERE ProjectCode = ?"
	rows1, err1 := connection.Query(query1, projectcode)
	if err1 != nil {
		fmt.Println(err1)
		// fmt.Println(err2)
	}
	defer rows1.Close()
	result := Moduls{}

	for rows1.Next() {
		modul := Modul{}

		eror := rows1.Scan(&modul.ModulCode, &modul.ModulName, &modul.ProjectCode, &modul.CreateBy, &modul.CreateDt, &modul.LastupBy, &modul.LastupDt)
		if eror != nil {
			fmt.Println(eror)
		}
		result.Moduls = append(result.Moduls, modul)
	}
	return result
}
// function untuk get data modul berdasarkan modulcode
func GetModulsById(c *CustomContext) Menu {
	modulcode := c.Param("modulcode");
	connection = config.Connection()
	query2 := "SELECT A.MenuCode, A.ModulCode, A.MenuDesc, A.Parent, A.CreateBy, A.CreateDt, A.LastUpBy, A.LastUpDt, B.`Status` FROM tblmodulmenu A LEFT JOIN tbldocumentdtl B ON B.MenuCode = A.MenuCode WHERE modulcode = ?"
	rows2, err2 := connection.Query(query2, modulcode)
	if err2 != nil{
		fmt.Println(err2)
	}
	defer rows2.Close()
	result := Menu{}

	for rows2.Next() {
		modulmenu := ModulMenu{}

		eror := rows2.Scan(&modulmenu.MenuCode, &modulmenu.ModulCode, &modulmenu.MenuDesc, &modulmenu.Parent, &modulmenu.CreateBy, &modulmenu.CreateDt, &modulmenu.LastupBy, &modulmenu.LastupDt, &modulmenu.Status)
		if eror != nil {
			fmt.Println(eror)
		}
		fmt.Println(modulmenu.MenuCode, modulmenu.Parent)
		result.Menu = append(result.Menu, modulmenu)
	}
	return result
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
