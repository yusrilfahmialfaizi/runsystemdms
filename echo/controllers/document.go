package controllers

import (
	"database/sql"
	"echo/models"
	"fmt"
	"net/http"

	"github.com/labstack/echo/v4"
)

// var con *sql.DB

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

		if err == nil {
			return c.JSON(http.StatusCreated, result)
		} else {
			return err
		}

	}
}
func PostDataDocumentsDtl(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error {

		var docdtl models.DocDtl

		c.Bind(&docdtl)

		result, err := models.PostDataDocumentsDtl(con, docdtl.Docno, docdtl.MenuCode, docdtl.Description, docdtl.Status, docdtl.CreateBy, docdtl.CreateDt, docdtl.LastUpBy, docdtl.LastUpDt)

		if err == nil {
			return c.JSON(http.StatusCreated, result)
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

		// _, err := models.EditDocHdr(con, editdochdr.Docno, editdochdr.ModulCode, editdochdr.Status, editdochdr.ActiveInd, editdochdr.CreateBy, editdochdr.CreateDt, editdochdr.LastUpBy, editdochdr.LastUpDt)
		_, err := models.EditDocDtl(con, editdochdr.Docno, editdochdr.MenuCode, editdochdr.Description, editdochdr.Status, editdochdr.LastUpBy, editdochdr.LastUpDt)

		if err == nil {
			return c.JSON(http.StatusOK, editdochdr)
		} else {
			return err
		}
	}
}
func EditDataDocumentsHdr(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error {

		var editdochdr models.UpDatadocumentHdr
		c.Bind(&editdochdr)

		// _, err := models.EditDocHdr(con, editdochdr.Docno, editdochdr.ModulCode, editdochdr.Status, editdochdr.ActiveInd, editdochdr.CreateBy, editdochdr.CreateDt, editdochdr.LastUpBy, editdochdr.LastUpDt)
		_, err := models.EditDocHdr(con, editdochdr.Docno, editdochdr.Status, editdochdr.LastUpBy, editdochdr.LastUpDt)

		if err == nil {
			return c.JSON(http.StatusOK, editdochdr)
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

func GenerateCode(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GenerateCode(cc)
	fmt.Println("Getting generate code...")
	return c.JSON(http.StatusOK, result)
}

func GetDocumentDtl(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetDocumentDtl(cc)
	fmt.Println("Getting generate code...")
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
