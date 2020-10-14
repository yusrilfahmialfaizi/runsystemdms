package controllers

import (
	"echo/models"
	"fmt"
	"net/http"

	"github.com/labstack/echo"
)

func GetUser(c echo.Context) error {
	result := models.GetUser()
	fmt.Println("HII")
	return c.JSON(http.StatusOK, result)
}
