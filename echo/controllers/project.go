package controllers

import (
	"database/sql"
	"echo/models"
	"fmt"
	"net/http"

	"github.com/labstack/echo/v4"
)

// Get Data Project
func GetProjectGroup(c echo.Context) error {
	result := models.GetProjectGroup()
	fmt.Println("Getting data ...")
	fmt.Println(result)
	return c.JSON(http.StatusOK, result)
}

// Get project by id
func GetProjectById(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetProjectById(cc)
	return c.JSON(http.StatusOK, result)
}

// POST method to INSERT Project
func PostProject(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error {
		var project models.ActionProject

		c.Bind(&project)
		result, err := models.PostProject(con, project.ProjectCode, project.ProjectName, project.ActInd, project.CtCode, project.CreateBy, project.CreateDt)

		if err != nil {
			return c.JSON(http.StatusCreated, result)
		} else {
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
		if err != nil {
			return err
		} else {
			return c.JSON(http.StatusOK, result)
		}
	}
}

//delete data
func DeleteProject(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.DeleteProjects(cc)
	fmt.Println("Delete ...")
	return c.JSON(http.StatusOK, result)
}
