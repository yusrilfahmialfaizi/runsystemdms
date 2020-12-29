package controllers

import (
	"database/sql"
	"echo/models"
	"net/http"

	"github.com/labstack/echo/v4"
)

// function get data document join tblgroupmenu
func GetLogById(c echo.Context) error {
	cc 		:= c.(*models.CustomContext)
	result 	:= models.GetLogById(cc)
	return c.JSON(http.StatusOK, result)
}
//function controller untuk create data document
func PostLog(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error {

		var log models.Log

		c.Bind(&log)

		result, err := models.PostLog(con, log.Docno, log.LastupBy, log.LastupDt)

		if err == nil {
			return c.JSON(http.StatusCreated, result)
		} else {
			return err
		}

	}
}