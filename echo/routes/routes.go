package routes

import (
	"database/sql"
	"echo/controllers"
	"echo/models"
	"net/http"

	"github.com/labstack/echo/v4"
	"github.com/labstack/echo/v4/middleware"
)

func Routes() *echo.Echo {
	// echo instance
	e := echo.New()

	// middleware
	e.Use(middleware.Logger())
	e.Use(middleware.Recover())
	e.Use(middleware.CORSWithConfig(middleware.CORSConfig{
		AllowOrigins: []string{"*"},
		AllowMethods: []string{echo.GET, echo.PUT, echo.POST, echo.DELETE},
	}))
	e.Use(func(next echo.HandlerFunc) echo.HandlerFunc {
		return func(c echo.Context) error {
			cc := &models.CustomContext{c}
			return next(cc)
		}
	})

	e.GET("/", func(c echo.Context) error {
		return c.JSON(http.StatusCreated, "Welcome mvc echo")
	})
	e.GET("/runsystemdms/getUsers", controllers.GetUser)
	e.POST("/runsystemdms/login", controllers.Login)
	e.GET("/runsystemdms/getPG", controllers.GetProjectGroup)
	e.GET("/runsystemdms/getModuls", controllers.GetModuls)
	// e.GET("/runsystemdms/getModulMenu", controllers.GetModulMenu)
	e.GET("/runsystemdms/getDynamicMenuParts", controllers.GetDynamicMenuParts)
	e.GET("/runsystemdms/getGenerateCode/:modulcode", controllers.GenerateCode)
	// e.GET("/runsystemdms/getLastChilds", controllers.GetLastChild)
	
	e.PUT("/runsystemdms/updateDataSubModules", controllers.UpdateDataSubModules)
	
	//routes document
	var con *sql.DB
	e.POST("/runsystemdms/getDocsDtl", controllers.GetDocumentDtl)
	e.GET("/runsystemdms/getDataDocuments", controllers.GetDatadocuments)
	e.POST("/runsystemdms/postDataDocuments", controllers.PostDataDocuments(con))
	e.POST("/runsystemdms/postDataDocumentsDtl", controllers.PostDataDocumentsDtl(con))
	e.PUT("/runsystemdms/editDataDocuments", controllers.EditDataDocuments(con))
	e.DELETE("/runsystemdms/deleteDocument", controllers.DelDocument)

	return e
}
