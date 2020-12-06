package controllers

import (
	"echo/models"
	_"fmt"
	"net/http"
	_"database/sql"

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