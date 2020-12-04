package controllers

import (
	"echo/models"
	"fmt"
	"net/http"
	"database/sql"

	"github.com/labstack/echo/v4"
)
// Get Data Project
func GetMenu(c echo.Context) error {
	result := models.GetMenu()
	fmt.Println("Getting data ...")
	return c.JSON(http.StatusOK, result)
}
// POST method to INSERT Project
func PostMenu(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error  {
		var menu models.ActionModulMenu

		c.Bind(&menu)
		result, err := models.PostMenu(con, menu.MenuCode, menu.ModulCode, menu.MenuDesc, menu.Parent, menu.CreateBy, menu.CreateDt)

		if err != nil {
			return c.JSON(http.StatusCreated, result)
		}else{
			return err
		}
	}
}

// Update data menu
func UpdateMenu(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error {
		var menu models.ActionModulMenu

		c.Bind(&menu)
		result, err := models.UpdateMenu(con, menu.MenuCode, menu.ModulCode, menu.MenuDesc, menu.Parent, menu.LastupBy, menu.LastupDt)
		if err != nil{
			return err
		}else{
			return c.JSON(http.StatusOK, result)
		}
	}
}