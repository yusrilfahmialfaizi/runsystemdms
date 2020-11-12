package controllers

import (
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
// function untuk get moduls berdasarkan modulcode
func GetModulsById(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetModulsById(cc)
	fmt.Println("Getting menu parent...")
	return c.JSON(http.StatusOK, result)
}
// Controller untuk get panjang data parent
func GetDynamicMenuParts(c echo.Context) error {
	result := models.GetDynamicMenuParts()
	fmt.Println("Getting parent length...")
	return c.JSON(http.StatusOK, result)
}
// Controller untuk update data
func UpdateDataSubModules(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.UpdateDataSubModules(cc)
	fmt.Println("Update data sub module ...")
	return c.JSON(http.StatusOK, result)
}
