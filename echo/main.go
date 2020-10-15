package main

import (
	"echo/controllers"
	"net/http"

	"github.com/labstack/echo/v4"
	"github.com/labstack/echo/v4/middleware"
)

func hello(c echo.Context) error {
	return c.String(http.StatusOK, "Hello")
}

func main() {
	// echo instance
	e := echo.New()

	// middleware
	e.Use(middleware.Logger())
	e.Use(middleware.Recover())
	e.Use(middleware.CORSWithConfig(middleware.CORSConfig{
		AllowOrigins: []string{"*"},
		AllowMethods: []string{echo.GET, echo.PUT, echo.POST, echo.DELETE},
	}))

	// Routes
	// e.GET("/", hello)
	e.GET("/", func(c echo.Context) error {
		return c.JSON(http.StatusCreated, "Welcome mvc echo")
	})
	e.GET("/runsystemdms/getUsers", controllers.GetUser)
	e.POST("/runsystemdms/login", controllers.Login)
	e.GET("/runsystemdms/getPG", controllers.GetProjectGroup)
	// start server
	e.Logger.Fatal(e.Start(":8080"))
}
