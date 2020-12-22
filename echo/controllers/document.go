package controllers

import (
	"database/sql"
	"echo/models"
	"fmt"
	"net/http"

	"github.com/labstack/echo/v4"
)

//function controller untuk get data document
func GetDatadocuments(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetDatadocuments(cc)
	fmt.Println("Getting data document...")
	return c.JSON(http.StatusOK, result)
}
func GetDataMenuCode(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetdataMenuCode(cc)
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
//function controller untuk create data document
func PostDataDocumentsDtl(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error {

		var insDatadocument models.InsDatadocumentDtl

		c.Bind(&insDatadocument)

		result, err := models.PostDataDocumentsDtl(con, insDatadocument.Docno, insDatadocument.MenuCode, insDatadocument.CreateBy, insDatadocument.CreateDt, insDatadocument.LastUpBy, insDatadocument.LastUpDt)

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
// function untuk controller update data document header 
func EditDataDocumentsHdr(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error {

		var editdochdr models.UpDatadocumentHdr
		c.Bind(&editdochdr)

		_, err := models.EditDocHdr(con, editdochdr.Docno, editdochdr.Status, editdochdr.LastUpBy, editdochdr.LastUpDt)

		if err == nil {
			return c.JSON(http.StatusOK, editdochdr)
		} else {
			return err
		}
	}
}

// function untuk mengambil 4 digit angka untuk generate code
func GenerateCode(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GenerateCode(cc)
	fmt.Println("Getting generate code...")
	return c.JSON(http.StatusOK, result)
}
// function pada controller untuk get documents dtl berdasarkan docno dan menucode
func GetDocumentDtl(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetDocumentDtl(cc)
	fmt.Println("Getting data...")
	return c.JSON(http.StatusOK, result)
}
// function pada controller untuk get documents dtl berdasarkan docno
func GetDocumentsDtl(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetDocumentsDtl(cc)
	fmt.Println("Getting data...")
	return c.JSON(http.StatusOK, result)
}
// function get data document join tblmodulmenu
func GetDocumentsDtlPrint(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetDocumentsDtlPrint(cc)
	fmt.Println("Getting data...")
	return c.JSON(http.StatusOK, result)
}
// function get data document join tblgroupmenu
func GetDocumentDtlById(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetDocumentDtlById(cc)
	fmt.Println("Getting data...")
	return c.JSON(http.StatusOK, result)
}

