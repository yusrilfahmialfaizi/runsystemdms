package main

import (
	"echo/routes"
)

func main() {
	// Routes
	e := routes.Routes()
	e.Logger.Fatal(e.Start(":8080"))
}
