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

//function controller untuk create data document
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

//function controller untuk edit data document
func EditDataDocuments(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error {

		var editdochdr models.InsDatadocument
		c.Bind(&editdochdr)

		_, err := models.EditDocHdr(con, editdochdr.Docno, editdochdr.ModulCode, editdochdr.Status, editdochdr.ActiveInd, editdochdr.CreateBy, editdochdr.CreateDt, editdochdr.LastUpBy, editdochdr.LastUpDt)
		result2, err := models.EditDocDtl(con, editdochdr.Docno, editdochdr.MenuCode, editdochdr.Description, editdochdr.Status, editdochdr.CreateBy, editdochdr.CreateDt, editdochdr.LastUpBy, editdochdr.LastUpDt)

		if err == nil {
			return c.JSON(http.StatusOK, H{
				"updated":    editdochdr,
				"updated to": result2,
			})
		} else {
			return err
		}
	}
}

func DelDocument(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.DeleteDocs(cc)
	fmt.Println("Update data sub module ...")
	return c.JSON(http.StatusOK, result)
}

//function controller untuk delete data document
// func DelDocument(con *sql.DB) echo.HandlerFunc {
// 	return func(c echo.Context) error {

// 		docno, _ := strconv.Atoi(c.Param("docno"))
// 		// docs := strconv.Itoa(int(docno))
// 		_, err := models.DeleteDocs(con, docno)

// 		if err == nil {
// 			return c.JSON(http.StatusOK, H{
// 				"deleted": docno,
// 			})
// 		} else {
// 			return err
// 		}

// 	}
// }
