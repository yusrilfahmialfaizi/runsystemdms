package controllers

import (
	"database/sql"
	"echo/models"
	"fmt"
	"net/http"
	"strings"
	_"time"

	"github.com/dgrijalva/jwt-go"

	"github.com/labstack/echo/v4"
)

type Response struct {
	Message string `json:"message"`
}

// function untuk get user
func GetUser(c echo.Context) error {
	result := models.GetUser()
	fmt.Println("Getting data ...")
	return c.JSON(http.StatusOK, result)
}
// get privilege
func GetPrivilege(c echo.Context) error {
	result := models.GetPrivilege()
	fmt.Println("Getting data ...")
	return c.JSON(http.StatusOK, result)
}

// function untuk get privilege
func GetPrivilegeById(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetPrivilegeById(cc)
	return c.JSON(http.StatusOK, result)
}
// function untuk get user
func GetUserById(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.GetUserById(cc)
	return c.JSON(http.StatusOK, result)
}

// POST method to INSERT User
func PostUser(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error {
		var user models.ActionUser

		c.Bind(&user)
		result, err := models.PostUser(con, user.UserCode, user.Username, user.PrivilegeCode, user.GrpCode, user.Pwd, user.ExpDt, user.NotifyInd, user.HasQiscusAccount, user.AvatarImage, user.DeviceId, user.CreateBy, user.CreateDt)

		if err != nil {
			return c.JSON(http.StatusCreated, result)
		} else {
			return err
		}
	}
}
// POST method to INSERT Privilege
func PostPrivilege(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error {
		var privilege models.ActionPrivilege

		c.Bind(&privilege)
		result, err := models.PostPrivileges(con, privilege.PrivilegeCode, privilege.PrivilegeName, privilege.CreateBy, privilege.CreateDt)

		if err != nil {
			return c.JSON(http.StatusCreated, result)
		} else {
			return err
		}
	}
}

// Update data privilege
func UpdatePrivileges(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error {
		var privilege models.ActionPrivilege

		c.Bind(&privilege)
		result, err := models.UpdatePrivileges(con, privilege.PrivilegeCode, privilege.PrivilegeName, privilege.LastupBy, privilege.LastupDt, privilege.PrivilegeCode_old)
		if err != nil {
			return err
		} else {
			return c.JSON(http.StatusOK, result)
		}
	}
}
// Update data user
func UpdateUsers(con *sql.DB) echo.HandlerFunc {
	return func(c echo.Context) error {
		var user models.ActionUser

		c.Bind(&user)
		result, err := models.UpdateUsers(con, user.UserCode, user.Username, user.PrivilegeCode, user.GrpCode, user.Pwd, user.ExpDt, user.NotifyInd, user.HasQiscusAccount, user.AvatarImage, user.DeviceId, user.LastupBy, user.LastupDt, user.UserCode_old)
		if err != nil {
			return err
		} else {
			return c.JSON(http.StatusOK, result)
		}
	}
}

func Login(c echo.Context) (err error) {
	usercode := c.FormValue("usercode")
	usr := strings.ToLower(usercode)
	usr2 := strings.ToUpper(usercode)
	pwd := c.FormValue("pwd")
	result := models.GetUser()
	response := Response{}
	for i := 0; i < len(result.Users); i++ {
		if usr == result.Users[i].UserCode || usr2 == result.Users[i].UserCode {
			if pwd == result.Users[i].Pwd {
				// membuat token
				token := jwt.New(jwt.SigningMethodHS256)

				// set claims yang bisa digunakn di frontend
				claims := token.Claims.(jwt.MapClaims)
				claims["usercode"] 		= result.Users[i].UserCode
				claims["username"] 		= result.Users[i].Username
				claims["privilegecode"] 	= result.Users[i].PrivilegeCode
				claims["grpcode"] 		= result.Users[i].GrpCode

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

//delete data
func DeleteUser(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.DeleteUsers(cc)
	fmt.Println("Delete ...")
	return c.JSON(http.StatusOK, result)
}
//delete data
func DeletePrivilege(c echo.Context) error {
	cc := c.(*models.CustomContext)
	result := models.DeletePrivilege(cc)
	fmt.Println("Delete ...")
	return c.JSON(http.StatusOK, result)
}
