package controllers

import (
	"echo/models"
	"fmt"
	"net/http"
	"database/sql"

	"github.com/labstack/echo/v4"
)
// Get Data Project
func GetProjectGroup(c echo.Context) error {
	result := models.GetProjectGroup()
	fmt.Println("Getting data ...")
	fmt.Println(result)
	return c.JSON(http.StatusOK, result)
}
// POST method to INSERT Project
func PostProject(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error  {
		var project models.ActionProject

		c.Bind(&project)
		result, err := models.PostProject(con, project.ProjectCode, project.ProjectName, project.ActInd, project.CtCode, project.CreateBy, project.CreateDt)

		if err != nil {
			return c.JSON(http.StatusCreated, result)
		}else{
			return err
		}
	}
}

// Update data Project
func UpdateProject(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error {
		var project models.ActionProject

		c.Bind(&project)
		result, err := models.UpdateProjects(con, project.ProjectCode, project.ProjectName, project.ActInd, project.CtCode, project.LastupBy, project.LastupDt)
		if err != nil{
			return err
		}else{
			return c.JSON(http.StatusOK, result)
		}
	}
}