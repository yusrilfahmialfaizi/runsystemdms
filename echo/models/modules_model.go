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
	ModulCode   string          `json:"modulcode"`
	ModulName   string          `json:"modulname"`
	ProjectCode string          `json:"projectcode"`
	CreateBy    string          `json:"createby"`
	CreateDt    string          `json:"createdt"`
	LastupBy    nullable.String `json:"lastupby"`
	LastupDt    nullable.String `json:"lastupdt"`
	ProjectName nullable.String `json:"projectname"`
}
type ActionModul struct {
	ModulCode     string `json:"modulcode"`
	ModulName     string `json:"modulname"`
	ProjectCode   string `json:"projectcode"`
	CreateBy      string `json:"createby"`
	CreateDt      string `json:"createdt"`
	LastupBy      string `json:"lastupby"`
	LastupDt      string `json:"lastupdt"`
	ModulCode_old string `json:"modulcode_old"`
}

type MenuAddDocument struct {
	MenuCode  string          `json:"menucode"`
	ModulCode string          `json:"modulcode"`
	MenuDesc  string          `json:"menudesc"`
	Parent    nullable.String `json:"parent"`
	CreateBy  string          `json:"createby"`
	CreateDt  string          `json:"createdt"`
	LastupBy  nullable.String `json:"lastupby"`
	LastupDt  nullable.String `json:"lastupdt"`
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
	MenuCode  string          `json:"menucode"`
	ModulCode string          `json:"modulcode"`
	MenuDesc  string          `json:"menudesc"`
	Parent    nullable.String `json:"parent"`
	CreateBy  string          `json:"createby"`
	CreateDt  string          `json:"createdt"`
	LastupBy  nullable.String `json:"lastupby"`
	LastupDt  nullable.String `json:"lastupdt"`
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
	ParentLengths []ParentLength `json:"parentlength"`
	LastChilds    []LastChild    `json:"lastChilds"`
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
	query1 := "SELECT A.*, B.ProjectName FROM tblmodul A LEFT JOIN tblproject B ON A.ProjectCode = B.ProjectCode"
	rows1, err1 := connection.Query(query1)
	if err1 != nil {
		fmt.Println(err1)
		// fmt.Println(err2)
	}
	defer rows1.Close()
	result := Moduls{}

	for rows1.Next() {
		modul := Modul{}

		eror := rows1.Scan(&modul.ModulCode, &modul.ModulName, &modul.ProjectCode, &modul.CreateBy, &modul.CreateDt, &modul.LastupBy, &modul.LastupDt, &modul.ProjectName)
		if eror != nil {
			fmt.Println(eror)
		}
		result.Moduls = append(result.Moduls, modul)
	}
	return result
}
func GetModulsById(c *CustomContext) Moduls {
	modulcode := c.Param("modulcode")
	connection = config.Connection()
	query1 := "SELECT A.*, B.ProjectName FROM tblmodul A LEFT JOIN tblproject B ON A.ProjectCode = B.ProjectCode WHERE A.modulcode = ?"
	rows1, err1 := connection.Query(query1, modulcode)
	if err1 != nil {
		fmt.Println(err1)
		// fmt.Println(err2)
	}
	defer rows1.Close()
	result := Moduls{}

	for rows1.Next() {
		modul := Modul{}

		eror := rows1.Scan(&modul.ModulCode, &modul.ModulName, &modul.ProjectCode, &modul.CreateBy, &modul.CreateDt, &modul.LastupBy, &modul.LastupDt, &modul.ProjectName)
		if eror != nil {
			fmt.Println(eror)
		}
		result.Moduls = append(result.Moduls, modul)
	}
	return result
}
func GetModulsWithId(c *CustomContext) Moduls {
	projectcode := c.Param("projectcode")
	connection = config.Connection()
	query1 := "SELECT A.*, B.ProjectName FROM tblmodul A LEFT JOIN tblproject B ON A.ProjectCode = B.ProjectCode WHERE A.ProjectCode = ?"
	rows1, err1 := connection.Query(query1, projectcode)
	if err1 != nil {
		fmt.Println(err1)
		// fmt.Println(err2)
	}
	defer rows1.Close()
	result := Moduls{}

	for rows1.Next() {
		modul := Modul{}

		eror := rows1.Scan(&modul.ModulCode, &modul.ModulName, &modul.ProjectCode, &modul.CreateBy, &modul.CreateDt, &modul.LastupBy, &modul.LastupDt, &modul.ProjectName)
		if eror != nil {
			fmt.Println(eror)
		}
		result.Moduls = append(result.Moduls, modul)
	}
	return result
}

// function untuk get data menu berdasarkan modulcode
func GetMenusById(c *CustomContext) Menu {
	modulcode := c.Param("modulcode")
	connection = config.Connection()
	query2 := "SELECT A.MenuCode, A.ModulCode, A.MenuDesc, A.Parent, A.CreateBy, A.CreateDt, A.LastUpBy, A.LastUpDt, B.`Status` FROM tblmodulmenu A LEFT JOIN tbldocumentdtl B ON B.MenuCode = A.MenuCode WHERE modulcode = ?"
	rows2, err2 := connection.Query(query2, modulcode)
	if err2 != nil {
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

// Insert data modul
func PostModul(con *sql.DB, ModulCode string, ModulName string, ProjectCode string, CreateBy string, CreateDt string) (int64, error) {
	con = config.Connection()

	query := "INSERT INTO tblmodul (ModulCode, ModulName, ProjectCode, CreateBy, CreateDt) VALUES(?, ?, ?, ?, ?)"

	stmt, err := con.Prepare(query)

	if err != nil {
		panic(err)
	}
	defer stmt.Close()

	result, eror := stmt.Exec(ModulCode, ModulName, ProjectCode, CreateBy, CreateDt)

	if eror != nil {
		panic(eror)
	}
	return result.RowsAffected()
}

func UpdateModul(con *sql.DB, ModulCode string, ModulName string, ProjectCode string, LastupBy string, LastupDt string, ModulCode_old string) (int64, error) {
	con = config.Connection()

	query := "UPDATE tblmodul set ModulCode = ?, ModulName = ?, ProjectCode = ?, LastUpBy = ?, LastUpDt = ? WHERE ModulCode = ?"

	stmt, err := con.Prepare(query)

	if err != nil {
		panic(err)
	}

	result, eror := stmt.Exec(ModulCode, ModulName, ProjectCode, LastupBy, LastupDt, ModulCode_old)

	if eror != nil {
		panic(eror)
	}
	return result.RowsAffected()
}

func DeleteModules(c *CustomContext) Moduls {
	connection := config.Connection()
	modulcode := c.FormValue("modulcode")
	query := "DELETE FROM tblmodul WHERE tblmodul.ModulCode = ?"

	rows, eror := connection.Query(query, modulcode)
	if eror != nil {
		fmt.Println(eror)
	}
	defer rows.Close()
	result := Moduls{}

	if rows.Next() {
		modul := Modul{}
		eror2 := rows.Scan(&modul.ModulCode)
		if eror2 != nil {
			fmt.Println(eror2)
		}
		result.Moduls = append(result.Moduls, modul)
	}
	return result
}
