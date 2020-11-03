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

type Menuparent struct {
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
type ParentLength struct {
	ParentLength nullable.String `json:"parentlength"`
}
type LastChild struct {
	MenuCode nullable.String `json:"menucode"`
}

type Menuparents struct {
	Menuparents []Menuparent `json:"menuparent"`
}

type ParentLengths struct {
	ParentLengths []ParentLength `json:"parentlength"`
}
type LastChilds struct {
	LastChilds []LastChild `json:"lastChilds"`
}

type Datasubmodules struct {
	Datasubmodules []Datasubmodule `json:"datasubmodule"`
}

var connection *sql.DB

// function untuk mengambil data dari tabel menu berdasarkan parent yang memiliki 2 digit angka
func GetMenuParents() Menuparents {
	connection = config.Connection()
	query := "SELECT MenuCode, MenuDesc, Parent, Param, Icon, StdInd, SpcInd, Visible, MenuCat, CreateBy, CreateDt, LastUpBy, LastUpDt FROM tblmenu "
	rows, err := connection.Query(query)
	if err != nil {
		fmt.Println(err)
	}
	defer rows.Close()
	result := Menuparents{}

	for rows.Next() {
		menuparent := Menuparent{}

		eror := rows.Scan(&menuparent.MenuCode, &menuparent.MenuDesc, &menuparent.Parent, &menuparent.Param, &menuparent.Icon, &menuparent.StdInd, &menuparent.SpcInd, &menuparent.Visible, &menuparent.MenuCat, &menuparent.CreateBy, &menuparent.CreateDt, &menuparent.LastupBy, &menuparent.LastupDt)
		if eror != nil {
			fmt.Println(eror)
		}
		result.Menuparents = append(result.Menuparents, menuparent)
	}
	return result
}

// function untuk mengambil panjang data parent dari tabel menu berdasarkan parent
func GetParentsLength() ParentLengths {
	connection = config.Connection()
	query := "SELECT Length(parent) FROM tblmenu WHERE parent IS NOT NULL GROUP BY Length(parent) "
	rows, err := connection.Query(query)
	if err != nil {
		fmt.Println(err)
	}
	defer rows.Close()
	result := ParentLengths{}

	for rows.Next() {
		parentLength := ParentLength{}

		eror := rows.Scan(&parentLength.ParentLength)
		if eror != nil {
			fmt.Println(eror)
		}
		result.ParentLengths = append(result.ParentLengths, parentLength)
	}
	return result
}

//function untuk mengambil anak paling bontotadri tabel menu
func GetLastChild() LastChilds {
	connection = config.Connection()
	query := "SELECT menucode FROM tblmenu A WHERE EXISTS (SELECT NULL FROM tblmenu B WHERE B.parent = A.MenuCode)"
	rows, eror1 := connection.Query(query)
	if eror1 != nil {
		fmt.Println("eror 1 : ", eror1)
	}
	defer rows.Close()
	result := LastChilds{}
	for rows.Next() {
		lastChild := LastChild{}
		eror2 := rows.Scan(&lastChild.MenuCode)
		if eror2 != nil {
			fmt.Println("eror 2 : ", eror2)
		}
		result.LastChilds = append(result.LastChilds, lastChild)
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
