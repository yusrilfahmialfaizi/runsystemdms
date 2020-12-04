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
	var con *sql.DB
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
	e.POST("/runsystemdms/login", controllers.Login)

	e.GET("/runsystemdms/getUsers", controllers.GetUser)
	e.POST("/runsystemdms/postUsers", controllers.PostUser(con))
	e.PUT("/runsystemdms/updateUsers", controllers.UpdateUsers(con))
	
	e.GET("/runsystemdms/getPG", controllers.GetProjectGroup)
	e.POST("/runsystemdms/postProject", controllers.PostProject(con))
	e.PUT("/runsystemdms/updateProject", controllers.UpdateProject(con))
	
	e.GET("/runsystemdms/getMenu", controllers.GetMenu)
	e.POST("/runsystemdms/postMenu", controllers.PostMenu(con))
	e.PUT("/runsystemdms/updateMenu", controllers.UpdateMenu(con))
	
	e.GET("/runsystemdms/getModuls", controllers.GetModuls)
	e.POST("/runsystemdms/postModuls", controllers.PostModul(con))
	e.PUT("/runsystemdms/updateModuls", controllers.UpdateModuls(con))
	e.GET("/runsystemdms/getModulsWithId/:projectcode", controllers.GetModulsWithId)
	e.GET("/runsystemdms/getModulsByID/:modulcode", controllers.GetModulsById)
	
	//routes document
	e.GET("/runsystemdms/getGenerateCode/:modulcode", controllers.GenerateCode)
	e.POST("/runsystemdms/getDocsDtl", controllers.GetDocumentDtl)
	e.POST("/runsystemdms/getDocsDtlForMenu", controllers.GetDocumentsDtl)
	e.POST("/runsystemdms/getDocsDtlForPrint", controllers.GetDocumentsDtlPrint)
	e.POST("/runsystemdms/getDataMenuCode", controllers.GetDataMenuCode)
	e.GET("/runsystemdms/getDataDocuments/:modulcode", controllers.GetDatadocuments)
	e.POST("/runsystemdms/postDataDocuments", controllers.PostDataDocuments(con))
	e.POST("/runsystemdms/postDataDocumentsDtl", controllers.PostDataDocumentsDtl(con))
	e.PUT("/runsystemdms/editDataDocuments", controllers.EditDataDocuments(con))
	e.PUT("/runsystemdms/editDataDocumentshdr", controllers.EditDataDocumentsHdr(con))

	return e
}
