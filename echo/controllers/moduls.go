package controllers

import (
	"database/sql"
	"echo/models"
	"fmt"
	"net/http"

	"github.com/labstack/echo/v4"
)

// Controller untuk get data
func GetModuls(c echo.Context) error {
	result := models.GetModuls()
	fmt.Println("Getting menu parent...")
	return c.JSON(http.StatusOK, result)
}

// POST method to INSERT modul
func PostModul(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error {
		var modul models.ActionModul

		c.Bind(&modul)
		result, err := models.PostModul(con, modul.ModulCode, modul.ModulName, modul.ProjectCode, modul.CreateBy, modul.CreateDt)

		if err != nil {
			return c.JSON(http.StatusCreated, result)
		} else {
			return err
		}
	}
}

// Update data modul
func UpdateModuls(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error {
		var modul models.ActionModul

		c.Bind(&modul)
		result, err := models.UpdateModul(con, modul.ModulCode, modul.ModulName, modul.ProjectCode, modul.LastupBy, modul.LastupDt, modul.ModulCode_old)
		if err != nil {
			return err
		} else {
			return c.JSON(http.StatusOK, result)
		}
	}
}
func GetModulsWithId(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetModulsWithId(cc)
	return c.JSON(http.StatusOK, result)
}

// function untuk get menu berdasarkan modulcode
func GetMenusById(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetMenusById(cc)
	return c.JSON(http.StatusOK, result)
}

// get modul by id
func GetModulsById(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetModulsById(cc)
	return c.JSON(http.StatusOK, result)
}

//delete modul
func DeleteModule(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.DeleteModules(cc)
	return c.JSON(http.StatusOK, result)
}
