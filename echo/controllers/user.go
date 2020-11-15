package controllers

import (
	"echo/models"
	"fmt"
	"net/http"
	"strings"
	"time"

	"github.com/dgrijalva/jwt-go"

	"github.com/labstack/echo/v4"
)

type Response struct {
	Message string `json:"message"`
}

func GetUser(c echo.Context) error {
	result := models.GetUser()
	fmt.Println("Getting data ...")
	return c.JSON(http.StatusOK, result)
}

func Login(c echo.Context) (err error) {
	usercode := c.FormValue("usercode")
	usr := strings.ToLower(usercode)
	usr2 := strings.ToUpper(usercode)
	pwd := c.FormValue("pwd")
	result := models.GetUser()
	response := Response{}
	for i := 0; i < len(result.Users); i++ {
		fmt.Println(result.Users[i].UserCode)
		if usr == result.Users[i].UserCode || usr2 == result.Users[i].UserCode {
			if pwd == result.Users[i].Pwd {
				// membuat token
				token := jwt.New(jwt.SigningMethodHS256)

				// set claims yang bisa digunakn di frontend
				claims := token.Claims.(jwt.MapClaims)
				claims["usercode"] = result.Users[i].UserCode
				claims["username"] = result.Users[i].Username
				claims["grpcode"] = result.Users[i].GrpCode
				claims["exp"] = time.Now().Add(time.Hour * 72).Unix()

				// mencari kombinasi token dan mengirimkannya sebagai response
				t, err := token.SignedString([]byte("secret"))
				if err != nil {
					return err
				}

				return c.JSON(http.StatusOK, map[string]string{
					"token": t,
				})

			}
			response = Response{Message: "password salah"}
			return c.JSON(http.StatusOK, response)
		}
	}
	response = Response{Message: "username tidak terdaftar"}
	return c.JSON(http.StatusOK, response)
	// return c.JSON(http.StatusOK, response)
}

func GetProjectGroup(c echo.Context) error {
	result := models.GetProjectGroup()
	fmt.Println("Getting data ...")
	fmt.Println(result)
	return c.JSON(http.StatusOK, result)
}
