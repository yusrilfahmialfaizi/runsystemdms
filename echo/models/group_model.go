package models

import (
	"database/sql"
	_ "database/sql"
	"echo/config"
	"fmt"

	_ "github.com/labstack/echo/v4"
	nullable "gopkg.in/guregu/null.v3"
)

type Group struct {
	GrpCode  string          `json:"grpcode"`
	GrpName  string          `json:"grpname"`
	CreateBy string          `json:"createby"`
	CreateDt string          `json:"createdt"`
	LastupBy nullable.String `json:"lastupby"`
	LastupDt nullable.String `json:"lastupdt"`
}
type ActionGroup struct {
	GrpCode  		string `json:"grpcode"`
	GrpName  		string `json:"grpname"`
	CreateBy 		string `json:"createby"`
	CreateDt 		string `json:"createdt"`
	LastupBy 		string `json:"lastupby"`
	LastupDt 		string `json:"lastupdt"`
	GrpCode_old  	string `json:"grpcode_old"`
}

type Groups struct {
	Groups []Group `json:"group"`
}
type GroupMenu struct {
	MenuCode  string          `json:"menucode"`
	MenuDesc  string          `json:"menudesc"`
	GrpCode   string          `json:"grpcode"`
	GrpName   string          `json:"grpname"`
	AccessInd string          `json:"accessind"`
	CreateBy  string          `json:"createby"`
	CreateDt  string          `json:"createdt"`
	LastupBy  nullable.String `json:"lastupby"`
	LastupDt  nullable.String `json:"lastupdt"`
}
type ActionGroupMenu struct {
	MenuCode  	string `json:"menucode"`
	GrpCode   	string `json:"grpcode"`
	AccessInd 	string `json:"accessind"`
	CreateBy  	string `json:"createby"`
	CreateDt  	string `json:"createdt"`
	LastupBy  	string `json:"lastupby"`
	LastupDt  	string `json:"lastupdt"`
	MenuCode_old  	string `json:"menucode_old"`
	GrpCode_old   	string `json:"grpcode_old"`
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

		eror := rows1.Scan(&groupmenu.MenuCode, &groupmenu.MenuDesc, &groupmenu.GrpCode, &groupmenu.GrpName, &groupmenu.AccessInd, &groupmenu.CreateBy, &groupmenu.CreateDt, &groupmenu.LastupBy, &groupmenu.LastupDt)
		if eror != nil {
			fmt.Println(eror)
		}
		result.GroupMenus = append(result.GroupMenus, groupmenu)
	}
	return result
}

func GetGroupsMenuById(c *CustomContext) GroupMenus {
	menucode := c.FormValue("menucode")
	grpcode := c.FormValue("grpcode")
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

		eror := rows1.Scan(&groupmenu.MenuCode, &groupmenu.MenuDesc, &groupmenu.GrpCode, &groupmenu.GrpName, &groupmenu.AccessInd, &groupmenu.CreateBy, &groupmenu.CreateDt, &groupmenu.LastupBy, &groupmenu.LastupDt)
		if eror != nil {
			fmt.Println(eror)
		}
		result.GroupMenus = append(result.GroupMenus, groupmenu)
	}
	return result
}
func GetGroupsMenuWithId(c *CustomContext) GroupMenus {
	grpcode := c.Param("grpcode")
	connection = config.Connection()
	query1 := "SELECT A.MenuCode, B.MenuDesc, A.GrpCode, C.GrpName, A.AccessInd, A.CreateBy, A.CreateDt, A.LastUpBy, A.LastUpDt FROM tblgroupmenu A LEFT JOIN tblmodulmenu B ON B.MenuCode = A.MenuCode LEFT JOIN tblgroup C ON C.GrpCode = A.GrpCode WHERE A.GrpCode = ?"
	rows1, err1 := connection.Query(query1, grpcode)
	if err1 != nil {
		fmt.Println(err1)
	}
	defer rows1.Close()
	result := GroupMenus{}

	for rows1.Next() {
		groupmenu := GroupMenu{}

		eror := rows1.Scan(&groupmenu.MenuCode, &groupmenu.MenuDesc, &groupmenu.GrpCode, &groupmenu.GrpName, &groupmenu.AccessInd, &groupmenu.CreateBy, &groupmenu.CreateDt, &groupmenu.LastupBy, &groupmenu.LastupDt)
		if eror != nil {
			fmt.Println(eror)
		}
		result.GroupMenus = append(result.GroupMenus, groupmenu)
	}
	return result
}

//function untuk untuk post data
func PostGroups(con *sql.DB, GrpCode string, GrpName string, CreateBy string, CreateDt string) (int64, error) {
	con = config.Connection()

	query := "INSERT INTO tblgroup (GrpCode, GrpName, CreateBy, CreateDt) values (?,?,?,?)"
	stmt1, err1 := con.Prepare(query)

	if err1 != nil {
		panic(err1)
	}
	defer stmt1.Close()

	result, er1 := stmt1.Exec(GrpCode, GrpName, CreateBy, CreateDt)

	if er1 != nil {
		panic(er1)
	}

	return result.RowsAffected()
}

func PostGroupMenus(con *sql.DB, MenuCode string, GrpCode string, AccessInd string, CreateBy string, CreateDt string) (int64, error) {
	con = config.Connection()

	query := "INSERT INTO tblgroupmenu (MenuCode, GrpCode, AccessInd, CreateBy, CreateDt) values (?,?,?,?,?)"
	stmt1, err1 := con.Prepare(query)

	if err1 != nil {
		panic(err1)
	}
	defer stmt1.Close()

	result, er1 := stmt1.Exec(MenuCode, GrpCode, AccessInd, CreateBy, CreateDt)

	if er1 != nil {
		panic(er1)
	}

	return result.RowsAffected()
}

// function untuk update
func UpdateGroups(con *sql.DB, GrpCode string, GrpName string, LastupBy string, LastupDt string, GrpCode_old string) (int64, error) {
	con = config.Connection()
	query := "UPDATE tblgroup set GrpCode = ?, GrpName = ?, LastUpBy = ?, LastUpDt = ? WHERE GrpCode = ?"

	stmt, err := con.Prepare(query)

	if err != nil {
		fmt.Println(err)
	}

	result, err2 := stmt.Exec(GrpCode, GrpName, LastupBy, LastupDt, GrpCode_old)

	if err2 != nil {
		fmt.Println(err2)
	}

	return result.RowsAffected()
}

func UpdateGroupMenus(con *sql.DB, MenuCode string, GrpCode string, AccessInd string, LastupBy string, LastupDt string, MenuCode_old string, GrpCode_old string) (int64, error) {
	con = config.Connection()
	query := "UPDATE tblgroupmenu set MenuCode = ?, GrpCode = ?, AccessInd = ?, LastUpBy = ?, LastUpDt = ? WHERE MenuCode = ? && GrpCode =?"

	stmt, err := con.Prepare(query)

	if err != nil {
		fmt.Println(err)
	}

	result, err2 := stmt.Exec(MenuCode, GrpCode, AccessInd, LastupBy, LastupDt, MenuCode_old, GrpCode_old)

	if err2 != nil {
		fmt.Println(err2)
	}

	return result.RowsAffected()
}

//func untuk delete data
func DeleteGroup(c *CustomContext) Groups {
	connection := config.Connection()
	grpcode := c.FormValue("grpcode")
	query := "DELETE FROM tblgroup WHERE tblgroup.GrpCode = ?"

	rows, eror := connection.Query(query, grpcode)
	if eror != nil {
		fmt.Println(eror)
	}
	defer rows.Close()
	result := Groups{}

	if rows.Next() {
		group := Group{}
		eror2 := rows.Scan(&group.GrpCode)
		if eror2 != nil {
			fmt.Println(eror2)
		}
		result.Groups = append(result.Groups, group)
	}
	return result
}

func DeleteGroupMenus(c *CustomContext) GroupMenus {
	connection := config.Connection()
	menucode := c.FormValue("menucode")
	grpcode := c.FormValue("grpcode")
	query := "DELETE FROM tblgroupmenu WHERE tblgroupmenu.MenuCode = ? AND tblgroupmenu.GrpCode = ?"

	rows, eror := connection.Query(query, menucode, grpcode)
	if eror != nil {
		fmt.Println(eror)
	}
	defer rows.Close()
	result := GroupMenus{}

	if rows.Next() {
		groupmenu := GroupMenu{}
		eror2 := rows.Scan(&groupmenu.MenuCode)
		if eror2 != nil {
			fmt.Println(eror2)
		}
		result.GroupMenus = append(result.GroupMenus, groupmenu)
	}
	return result
}
