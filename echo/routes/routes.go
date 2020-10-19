package routes

import (
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
	e.GET("/runsystemdms/getRootModules", controllers.GetRmodules)
	e.POST("/runsystemdms/getSubModules", controllers.GetSubModules)
	e.POST("/runsystemdms/getSubsubModules", controllers.GetSubsubmodules)
	e.PUT("/runsystemdms/saveDataSubModules", controllers.SaveDataSubModules)

	return e
}
