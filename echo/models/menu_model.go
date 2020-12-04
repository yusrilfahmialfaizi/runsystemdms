package models

import (
	"database/sql"
	"echo/config"
	"fmt"

	_"github.com/labstack/echo/v4"
	nullable "gopkg.in/guregu/null.v3"
)

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
type ActionModulMenu struct {
	MenuCode 	string	`json:"menucode"`
	ModulCode	string	`json:"modulcode"`
	MenuDesc 	string	`json:"menudesc"`
	Parent   	string	`json:"parent"`
	CreateBy 	string	`json:"createby"`
	CreateDt 	string	`json:"createdt"`
	LastupBy 	string	`json:"lastupby"`
	LastupDt 	string	`json:"lastupdt"`
}



func GetMenu() Menu {
	con := config.Connection()
	queryStatement := "SELECT A.MenuCode, A.ModulCode, A.MenuDesc, A.Parent, A.CreateBy, A.CreateDt, A.LastUpBy, A.LastUpDt FROM tblmodulmenu A "
	
	rows, err := con.Query(queryStatement)
	fmt.Println(err)
	if err != nil {
		fmt.Println(err)
	}
	defer rows.Close()
	result := Menu{}

	for rows.Next() {
		modulmenu := ModulMenu{}

		eror := rows.Scan(&modulmenu.MenuCode, &modulmenu.ModulCode, &modulmenu.MenuDesc, &modulmenu.Parent, &modulmenu.CreateBy, &modulmenu.CreateDt, &modulmenu.LastupBy, &modulmenu.LastupDt)
		if eror != nil {
			fmt.Println(eror)
		}
		fmt.Println(modulmenu.MenuCode, modulmenu.Parent)
		result.Menu = append(result.Menu, modulmenu)
	}
	return result
}
// for Insert User
func PostMenu(con *sql.DB, MenuCode string, ModulCode string, MenuDesc string, Parent string, CreateBy string, CreateDt string)(int64, error){
	con = config.Connection()

	query := "INSERT INTO tblModulMenu (MenuCode, ModulCode, MenuDesc, Parent,  CreateBy, CreateDt) VALUES (?,?,?,?,?,?,?)"

	stmt, err := con.Prepare(query)

	if err != nil{
		fmt.Println(err)
	}

	defer stmt.Close()

	result, eror := stmt.Exec(MenuCode, ModulCode, MenuDesc, Parent, CreateBy, CreateDt)

	if eror != nil{
		fmt.Println(eror)
	}

	return result.RowsAffected()
}
// Update data Menus
func UpdateMenu(con *sql.DB, MenuCode string, ModulCode string, MenuDesc string, Parent string, LastupBy string, LastupDt string)(int64, error){
	con = config.Connection()

	query := "UPDATE tblModulMenu set MenuCode = ?, ModulCode = ?, MenuDesc = ?, Parent = ?, LastUpBy = ?, LastUpDt = ? WHERE MenuCode = ?"

	stmt, err := con.Prepare(query)

	if err != nil {
		panic(err)
	}

	result, eror := stmt.Exec(MenuCode, ModulCode, MenuDesc, Parent, LastupBy, LastupDt, MenuCode)

	if eror != nil{
		panic(eror)
	}
	return result.RowsAffected()
}