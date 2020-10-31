package controllers

import (
	"database/sql"
	"echo/models"
	"fmt"
	"net/http"

	"github.com/labstack/echo/v4"
)

// var con *sql.DB

type H map[string]interface{}

//function controller untuk get data document
func GetDatadocuments(c echo.Context) error {
	result := models.GetDatadocuments()
	fmt.Println("Getting data document...")
	return c.JSON(http.StatusOK, result)
}

//function controller untuk create tbldocument hdr & tbldocumentdtl
func PostDataDocuments(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error {

		var insDatadocument models.InsDatadocument

		c.Bind(&insDatadocument)

		result, err := models.PostDataDocuments(con, insDatadocument.Docno, insDatadocument.ModulCode, insDatadocument.Status, insDatadocument.ActiveInd, insDatadocument.CreateBy, insDatadocument.CreateDt, insDatadocument.LastUpBy, insDatadocument.LastUpDt)
		result2, err := models.PostDataDocumentsDtl(con, insDatadocument.Docno, insDatadocument.MenuCode, insDatadocument.Description, insDatadocument.Status, insDatadocument.CreateBy, insDatadocument.CreateDt, insDatadocument.LastUpBy, insDatadocument.LastUpDt)

		if err == nil {
			return c.JSON(http.StatusCreated, H{
				"created":       result,
				"created again": result2,
			})
		} else {
			return err
		}

	}
}
