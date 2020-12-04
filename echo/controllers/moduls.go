package controllers

import (
	"echo/models"
	"fmt"
	"net/http"
	"database/sql"

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
	return func(c echo.Context) error  {
		var modul models.ActionModul

		c.Bind(&modul)
		result, err := models.PostModul(con, modul.ModulCode, modul.ModulName, modul.ProjectCode,modul.CreateBy, modul.CreateDt)

		if err != nil {
			return c.JSON(http.StatusCreated, result)
		}else{
			return err
		}
	}
}

// Update data modul
func UpdateModuls(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error {
		var modul models.ActionModul

		c.Bind(&modul)
		result, err := models.UpdateModul(con, modul.ModulCode, modul.ModulName, modul.ProjectCode,modul.LastupBy, modul.LastupDt)
		if err != nil{
			return err
		}else{
			return c.JSON(http.StatusOK, result)
		}
	}
}
func GetModulsWithId(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetModulsWithId(cc)
	fmt.Println("Getting menu parent...")
	return c.JSON(http.StatusOK, result)
}
// function untuk get moduls berdasarkan modulcode
func GetModulsById(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetModulsById(cc)
	fmt.Println("Getting menu parent...")
	return c.JSON(http.StatusOK, result)
}

