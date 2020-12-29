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
	e.GET("/runsystemdms/getUsersById/:usercode", controllers.GetUserById)
	e.POST("/runsystemdms/postUsers", controllers.PostUser(con))
	e.PUT("/runsystemdms/updateUsers", controllers.UpdateUsers(con))
	e.GET("/runsystemdms/getPG", controllers.GetProjectGroup)
	e.GET("/runsystemdms/getProject", controllers.GetProject)
	e.GET("/runsystemdms/getProjectById/:projectcode", controllers.GetProjectById)
	e.POST("/runsystemdms/postProject", controllers.PostProject(con))
	e.PUT("/runsystemdms/updateProject", controllers.UpdateProject(con))

	e.GET("/runsystemdms/getLogById", controllers.GetLogById)
	e.POST("/runsystemdms/postLog", controllers.PostLog(con))

	e.GET("/runsystemdms/getMenu", controllers.GetMenu)
	e.GET("/runsystemdms/getMenuWithId/:menucode", controllers.GetMenuWithId)
	e.POST("/runsystemdms/postMenu", controllers.PostMenu(con))
	e.PUT("/runsystemdms/updateMenu", controllers.UpdateMenu(con))

	e.GET("/runsystemdms/getModuls", controllers.GetModuls)
	e.POST("/runsystemdms/postModuls", controllers.PostModul(con))
	e.PUT("/runsystemdms/updateModuls", controllers.UpdateModuls(con))
	e.GET("/runsystemdms/getModulsWithId/:projectcode", controllers.GetModulsWithId)
	e.GET("/runsystemdms/getMenusByID/:modulcode", controllers.GetMenusById)
	e.POST("/runsystemdms/getModulByID", controllers.GetModulsById)

	e.GET("/runsystemdms/getGroup", controllers.GetGroup)
	e.GET("/runsystemdms/getGroupById/:grpcode", controllers.GetGroupById)

	e.GET("/runsystemdms/getGroupMenu", controllers.GetGroupMenu)
	e.POST("/runsystemdms/getGroupMenuById", controllers.GetGroupMenuById)
	e.GET("/runsystemdms/getGroupMenuWithId/:grpcode", controllers.GetGroupMenuWithId)

	//routes document
	// e.POST("/runsystemdms/getGenerateCode", controllers.GenerateCode)
	e.GET("/runsystemdms/getGenerateCode/:modulcode", controllers.GenerateCode)
	e.POST("/runsystemdms/getDocsDtl", controllers.GetDocumentDtl)
	e.POST("/runsystemdms/getDocsDtlForMenu", controllers.GetDocumentsDtl)
	e.POST("/runsystemdms/getDocsDtlForPrint", controllers.GetDocumentsDtlPrint)
	e.POST("/runsystemdms/getDocsDtlById", controllers.GetDocumentDtlById)
	e.POST("/runsystemdms/getDataMenuCode", controllers.GetDataMenuCode)
	e.POST("/runsystemdms/getDataDocuments", controllers.GetDatadocuments)
	e.POST("/runsystemdms/getDataDocumentsHdr", controllers.GetDatadocumentsHdr)
	e.POST("/runsystemdms/editActiveInd", controllers.EditActiveInd(con))
	e.POST("/runsystemdms/postDataDocuments", controllers.PostDataDocuments(con))
	e.POST("/runsystemdms/postDataDocumentsDtl", controllers.PostDataDocumentsDtl(con))
	e.PUT("/runsystemdms/editDataDocuments", controllers.EditDataDocuments(con))
	e.PUT("/runsystemdms/editDataDocumentshdr", controllers.EditDataDocumentsHdr(con))

	//sisi admin

	//group
	e.POST("/runsystemdms/postGroup", controllers.PostGroup(con))
	e.PUT("/runsystemdms/updateGroup", controllers.UpdateGroup(con))
	e.DELETE("/runsystemdms/deleteGroup", controllers.DeleteGroup)

	//group menu
	e.POST("/runsystemdms/postGroupMenu", controllers.PostGroupMenu(con))
	e.PUT("/runsystemdms/updateGroupMenu", controllers.UpdateGroupMenu(con))
	e.DELETE("/runsystemdms/deleteGroupMenu", controllers.DeleteGroupMenu)

	//route delete
	e.DELETE("/runsystemdms/deleteModulMenu", controllers.DeleteModulMenu)
	e.DELETE("/runsystemdms/deleteModule", controllers.DeleteModule)
	e.DELETE("/runsystemdms/deleteProject", controllers.DeleteProject)
	e.DELETE("/runsystemdms/deleteUser", controllers.DeleteUser)

	return e
}
