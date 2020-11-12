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
func GetModulsById(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetModulsById(cc)
	fmt.Println("Getting menu parent...")
	return c.JSON(http.StatusOK, result)
}
// func GetModulMenu(c echo.Context) error {
// 	result := models.GetModulMenu()
// 	fmt.Println("Getting menu parent...")
// 	return c.JSON(http.StatusOK, result)
// }

// Controller untuk get panjang data parent
func GetDynamicMenuParts(c echo.Context) error {
	result := models.GetDynamicMenuParts()
	fmt.Println("Getting parent length...")
	return c.JSON(http.StatusOK, result)
}

// Controller untuk get menucode anak paling bontot
// func GetLastChild(c echo.Context) error {
// 	result := models.GetLastChild()
// 	fmt.Println("Getting last childs .....")
// 	return c.JSON(http.StatusOK, result)
// }

// Controller untuk update data
func UpdateDataSubModules(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.UpdateDataSubModules(cc)
	fmt.Println("Update data sub module ...")
	return c.JSON(http.StatusOK, result)
}
