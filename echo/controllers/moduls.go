package controllers

import (
	"echo/models"
	"fmt"
	"net/http"

	"github.com/labstack/echo/v4"
)

func GetRmodules(c echo.Context) error {
	result := models.GetRootModules()
	fmt.Println("Getting root modules")
	return c.JSON(http.StatusOK, result)
}

func GetSubModules(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetSubModules(cc)
	fmt.Println("Getting submodule...")
	return c.JSON(http.StatusOK, result)
}
func GetSubsubmodules(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetSubsubmodules(cc)
	fmt.Println("Getting submodule...")
	return c.JSON(http.StatusOK, result)
}

func SaveDataSubModules(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.SaveDataSubModules(cc)
	fmt.Println("Update data sub module ...")
	return c.JSON(http.StatusOK, result)
}
