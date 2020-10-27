package controllers

import (
	"echo/models"
	"fmt"
	"net/http"

	"github.com/labstack/echo/v4"
)

func GetMenuparents(c echo.Context) error {
	result := models.GetMenuParents()
	fmt.Println("Getting menu parent...")
	return c.JSON(http.StatusOK, result)
}

func GetMenusubparents(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetMenusubparents(cc)
	fmt.Println("Getting sub menu parent...")
	return c.JSON(http.StatusOK, result)
}
func GetMenusubsubparents(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetMenusubsubparents(cc)
	fmt.Println("Getting submodule...")
	return c.JSON(http.StatusOK, result)
}

func SaveDataSubModules(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.SaveDataSubModules(cc)
	fmt.Println("Update data sub module ...")
	return c.JSON(http.StatusOK, result)
}
