package controllers

import (
	"database/sql"
	_ "database/sql"
	"echo/models"
	_ "fmt"
	"net/http"

	"github.com/labstack/echo/v4"
)

// Controller untuk get data
func GetGroup(c echo.Context) error {
	result := models.GetGroups()
	return c.JSON(http.StatusOK, result)
}
func GetGroupById(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetGroupsById(cc)
	return c.JSON(http.StatusOK, result)
}

// Controller untuk get data
func GetGroupMenu(c echo.Context) error {
	result := models.GetGroupsMenu()
	return c.JSON(http.StatusOK, result)
}
func GetGroupMenuById(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetGroupsMenuById(cc)
	return c.JSON(http.StatusOK, result)
}

//function controller untuk create data document
func PostGroup(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error {

		var actiongroup models.ActionGroup

		c.Bind(&actiongroup)

		result, err := models.PostGroups(con, actiongroup.GrpCode, actiongroup.GrpName, actiongroup.CreateBy, actiongroup.CreateDt, actiongroup.LastupBy, actiongroup.LastupDt)

		if err == nil {
			return c.JSON(http.StatusCreated, result)
		} else {
			return err
		}

	}
}

//function controller untuk update
func UpdateGroup(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error {

		var updategroup models.ActionGroup
		c.Bind(&updategroup)

		_, err := models.UpdateGroups(con, updategroup.GrpCode, updategroup.GrpName, updategroup.CreateBy, updategroup.CreateDt, updategroup.LastupBy, updategroup.LastupDt)

		if err == nil {
			return c.JSON(http.StatusOK, updategroup)
		} else {
			return err
		}
	}
}
