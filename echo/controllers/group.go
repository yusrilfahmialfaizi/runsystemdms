package controllers

import (
	"database/sql"
	_ "database/sql"
	"echo/models"
	"fmt"
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

//function controller untuk create
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

func PostGroupMenu(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error {

		var actiongroupmenu models.ActionGroupMenu

		c.Bind(&actiongroupmenu)

		result, err := models.PostGroupMenus(con, actiongroupmenu.MenuCode, actiongroupmenu.GrpCode, actiongroupmenu.AccessInd, actiongroupmenu.CreateBy, actiongroupmenu.CreateDt, actiongroupmenu.LastupBy, actiongroupmenu.LastupDt)

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

func UpdateGroupMenu(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error {

		var updategroupmenu models.ActionGroupMenu
		c.Bind(&updategroupmenu)

		_, err := models.UpdateGroupMenus(con, updategroupmenu.MenuCode, updategroupmenu.GrpCode, updategroupmenu.AccessInd, updategroupmenu.CreateBy, updategroupmenu.CreateDt, updategroupmenu.LastupBy, updategroupmenu.LastupDt)

		if err == nil {
			return c.JSON(http.StatusOK, updategroupmenu)
		} else {
			return err
		}
	}
}

//delete data group
func DeleteGroup(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.DeleteGroup(cc)
	fmt.Println("Delete ...")
	return c.JSON(http.StatusOK, result)
}

func DeleteGroupMenu(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.DeleteGroupMenus(cc)
	fmt.Println("Delete ...")
	return c.JSON(http.StatusOK, result)
}
