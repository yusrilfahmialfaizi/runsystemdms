package controllers

import (
	"echo/models"
	"fmt"
	"net/http"

	"github.com/labstack/echo/v4"
)

// Controller untuk get data
func GetMenuparents(c echo.Context) error {
	result := models.GetMenuParents()
	fmt.Println("Getting menu parent...")
	return c.JSON(http.StatusOK, result)
}
// Controller untuk get panjang data parent
func GetParentsLength(c echo.Context) error {
	result := models.GetParentsLength()
	fmt.Println("Getting parent length...")
	return c.JSON(http.StatusOK, result)
}

// Controller untuk get data
func GetMenusubparents(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetMenusubparents(cc)
	fmt.Println("Getting sub menu parent...")
	return c.JSON(http.StatusOK, result)
}

// Controller untuk get data
func GetMenusubsubparents(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetMenusubsubparents(cc)
	fmt.Println("Getting submodule...")
	return c.JSON(http.StatusOK, result)
}

// Controller untuk update data
func UpdateDataSubModules(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.UpdateDataSubModules(cc)
	fmt.Println("Update data sub module ...")
	return c.JSON(http.StatusOK, result)
}
