package models

import (
	"database/sql"
	"echo/config"
	"fmt"

	_ "github.com/labstack/echo/v4"
	nullable "gopkg.in/guregu/null.v3"
)

type PG struct {
	ProjectCode nullable.String `json:"projectcode"`
	ProjectName nullable.String `json:"projectname"`
	ActInd      string          `json:"actind"`
	CreateBy    string          `json:"createby"`
	CreateDt    string          `json:"createdt"`
	LastupBy    nullable.String `json:"lastupby"`
	LastupDt    nullable.String `json:"lastupdt"`
}
type ActionProject struct {
	ProjectCode string `json:"projectcode"`
	ProjectName string `json:"projectname"`
	ActInd      string `json:"actind"`
	CreateBy    string `json:"createby"`
	CreateDt    string `json:"createdt"`
	LastupBy    string `json:"lastupby"`
	LastupDt    string `json:"lastupdt"`
}

type PGs struct {
	PGs []PG `json:"pg"`
}

func GetProjectGroup() PGs {
	con := config.Connection()
	queryStatement := "Select projectCode, projectname, actind, createby, createdt,lastupby, lastupdt From tblproject Where actind = 'Y'"

	rows, err := con.Query(queryStatement)
	fmt.Println(err)
	if err != nil {
		fmt.Println(err)
	}
	defer rows.Close()
	result := PGs{}

	for rows.Next() {
		pg := PG{}

		er := rows.Scan(&pg.ProjectCode, &pg.ProjectName, &pg.ActInd, &pg.CreateBy, &pg.CreateDt, &pg.LastupBy, &pg.LastupDt)
		if er != nil {
			fmt.Println("ER : ", er)
		}
		result.PGs = append(result.PGs, pg)
	}
	return result
}
func GetProjectById(c *CustomContext) PGs {
	projectcode := c.Param("projectcode")
	con := config.Connection()
	queryStatement := "Select projectCode, projectname, actind, createby, createdt,lastupby, lastupdt From tblproject Where projectcode = ?"

	rows, err := con.Query(queryStatement, projectcode)
	fmt.Println("ROWS : ", rows)
	fmt.Println(err)
	if err != nil {
		fmt.Println(err)
	}
	defer rows.Close()
	result := PGs{}

	for rows.Next() {
		pg := PG{}

		er := rows.Scan(&pg.ProjectCode, &pg.ProjectName, &pg.ActInd, &pg.CreateBy, &pg.CreateDt, &pg.LastupBy, &pg.LastupDt)
		if er != nil {
			fmt.Println("ER : ", er)
		}
		result.PGs = append(result.PGs, pg)
	}
	return result
}

// for Insert User
func PostProject(con *sql.DB, ProjectCode string, Projectname string, ActInd string, CreateBy string, CreateDt string) (int64, error) {
	con = config.Connection()

	query := "INSERT INTO tblproject (ProjectCode, ProjectName, ActInd,  CreateBy, CreateDt) VALUES (?,?,?,?,?)"

	stmt, err := con.Prepare(query)

	if err != nil {
		fmt.Println(err)
	}

	defer stmt.Close()

	result, eror := stmt.Exec(ProjectCode, Projectname, ActInd, CreateBy, CreateDt)

	if eror != nil {
		fmt.Println(eror)
	}

	return result.RowsAffected()
}

// Update data Projects
func UpdateProjects(con *sql.DB, ProjectCode string, Projectname string, ActInd string, LastupBy string, LastupDt string) (int64, error) {
	con = config.Connection()

	query := "UPDATE tblproject set ProjectCode = ?, ProjectName = ?, ActInd = ?, LastUpBy = ?, LastUpDt = ? WHERE ProjectCode = ?"

	stmt, err := con.Prepare(query)

	if err != nil {
		panic(err)
	}

	result, eror := stmt.Exec(ProjectCode, Projectname, ActInd, LastupBy, LastupDt, ProjectCode)

	if eror != nil {
		panic(eror)
	}
	return result.RowsAffected()
}

func DeleteProjects(c *CustomContext) PGs {
	connection := config.Connection()
	projectcode := c.FormValue("projectcode")
	query := "DELETE FROM tblproject WHERE tblproject.ProjectCode = ?"

	rows, eror := connection.Query(query, projectcode)
	if eror != nil {
		fmt.Println(eror)
	}
	defer rows.Close()
	result := PGs{}

	if rows.Next() {
		pg := PG{}
		eror2 := rows.Scan(&pg.ProjectCode)
		if eror2 != nil {
			fmt.Println(eror2)
		}
		result.PGs = append(result.PGs, pg)
	}
	return result
}
