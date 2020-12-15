package models

import (
	"database/sql"
	"echo/config"
	"encoding/json"
	"fmt"
	"log"

	nullable "gopkg.in/guregu/null.v3"
)

type User struct {
	UserCode         string          `json:"usercode"`
	Username         string          `json:"username"`
	PrivilegeCode    string          `json:"privilegecode"`
	GrpCode          string          `json:"grpcode"`
	Pwd              string          `json:"pwd"`
	ExpDt            nullable.String `json:"expdt"`
	NotifyInd        string          `json:"notifyind"`
	HasQiscusAccount nullable.String `json:"hasqiscusaccout"`
	AvatarImage      nullable.String `json:"avatarimage"`
	DeviceId         nullable.String `json:"deviceid"`
	CreateBy         string          `json:"createby"`
	CreateDt         string          `json:"createdt"`
	LastupBy         nullable.String `json:"lastupby"`
	LastupDt         nullable.String `json:"lastupdt"`
}
type Privilege struct {
	PrivilegeCode    string          `json:"privilegecode"`
	PrivilegeName    string          `json:"privilegename"`
	CreateBy         string          `json:"createby"`
	CreateDt         string          `json:"createdt"`
	LastupBy         nullable.String `json:"lastupby"`
	LastupDt         nullable.String `json:"lastupdt"`
}
type ActionPrivilege struct {
	PrivilegeCode    	string          `json:"privilegecode"`
	PrivilegeName    	string          `json:"privilegename"`
	CreateBy         	string          `json:"createby"`
	CreateDt         	string          `json:"createdt"`
	LastupBy         	string		   `json:"lastupby"`
	LastupDt         	string		   `json:"lastupdt"`
	PrivilegeCode_old   string          `json:"privilegecode_old"`
}
type ActionUser struct {
	UserCode         string `json:"usercode"`
	Username         string `json:"username"`
	PrivilegeCode    string `json:"privilegecode"`
	GrpCode          string `json:"grpcode"`
	Pwd              string `json:"pwd"`
	ExpDt            string `json:"expdt"`
	NotifyInd        string `json:"notifyind"`
	HasQiscusAccount string `json:"hasqiscusaccout"`
	AvatarImage      string `json:"avatarimage"`
	DeviceId         string `json:"deviceid"`
	CreateBy         string `json:"createby"`
	CreateDt         string `json:"createdt"`
	LastupBy         string `json:"lastupby"`
	LastupDt         string `json:"lastupdt"`
	UserCode_old     string `json:"usercode_old"`
}

type Users struct {
	Users []User `json:"user"`
}
type Privileges struct {
	Privileges []Privilege `json:"privilege"`
}
type NullString struct {
	sql.NullString
}

// var con *sql.DB

func (ns *NullString) MarshalJSON() ([]byte, error) {
	if !ns.Valid {
		return []byte("null"), nil
	}
	return json.Marshal(ns.String)
}

func GetUser() Users {
	con := config.Connection()
	queryStatement := "Select usercode, username, privilegecode, grpcode, pwd, expdt, notifyind, hasqiscusaccount, avatarimage, deviceid, createby, createdt,lastupby, lastupdt From tbluser"

	rows, err := con.Query(queryStatement)
	fmt.Println(err)
	if err != nil {
		fmt.Println(err)
	}
	defer rows.Close()
	result := Users{}

	for rows.Next() {
		user := User{}

		er := rows.Scan(&user.UserCode, &user.Username, &user.PrivilegeCode,&user.GrpCode,
			&user.Pwd, &user.ExpDt, &user.NotifyInd, &user.HasQiscusAccount, &user.AvatarImage, &user.DeviceId,
			&user.CreateBy, &user.CreateDt, &user.LastupBy, &user.LastupDt)
		if er != nil {
			fmt.Println("ER : ", er)
		}
		userJSON, err := json.Marshal(&user)
		if err != nil {
			log.Fatal(err)
		} else {
			log.Printf("json marshal := %s\n\n", userJSON)
		}
		result.Users = append(result.Users, user)
	}
	return result
}
func GetPrivilege() Privileges {
	con := config.Connection()
	queryStatement := "SELECT * FROM tblprivilege"

	rows, err := con.Query(queryStatement)
	fmt.Println(err)
	if err != nil {
		fmt.Println(err)
	}
	defer rows.Close()
	result := Privileges{}

	for rows.Next() {
		pr := Privilege{}

		er := rows.Scan(&pr.PrivilegeCode, &pr.PrivilegeName, &pr.CreateBy, &pr.CreateDt, &pr.LastupBy, &pr.LastupDt)
		if er != nil {
			fmt.Println("ER : ", er)
		}
		
		result.Privileges = append(result.Privileges, pr)
	}
	return result
}
func GetPrivilegeById(c *CustomContext) Privileges {
	privilegecode := c.Param("privilegecode")
	con := config.Connection()
	queryStatement := "Select * From tblprivilege WHERE privilegecode = ?"

	rows, err := con.Query(queryStatement, privilegecode)
	if err != nil {
		fmt.Println(err)
	}
	defer rows.Close()
	result := Privileges{}

	for rows.Next() {
		pr := Privilege{}

		er := rows.Scan(&pr.PrivilegeCode, &pr.PrivilegeName, &pr.CreateBy, &pr.CreateDt, &pr.LastupBy, &pr.LastupDt)
		if er != nil {
			fmt.Println("ER : ", er)
		}
		result.Privileges = append(result.Privileges, pr)
	}
	return result
}
func GetUserById(c *CustomContext) Users {
	usercode := c.Param("usercode")
	con := config.Connection()
	queryStatement := "Select usercode, username, privilegecode, grpcode, pwd, expdt, notifyind, hasqiscusaccount, avatarimage, deviceid, createby, createdt,lastupby, lastupdt From tbluser WHERE usercode = ?"

	rows, err := con.Query(queryStatement, usercode)
	fmt.Println(err)
	if err != nil {
		fmt.Println(err)
	}
	defer rows.Close()
	result := Users{}

	for rows.Next() {
		user := User{}

		er := rows.Scan(&user.UserCode, &user.Username,&user.PrivilegeCode, &user.GrpCode,
			&user.Pwd, &user.ExpDt, &user.NotifyInd, &user.HasQiscusAccount, &user.AvatarImage, &user.DeviceId,
			&user.CreateBy, &user.CreateDt, &user.LastupBy, &user.LastupDt)
		if er != nil {
			fmt.Println("ER : ", er)
		}
		userJSON, err := json.Marshal(&user)
		if err != nil {
			log.Fatal(err)
		} else {
			log.Printf("json marshal := %s\n\n", userJSON)
		}
		result.Users = append(result.Users, user)
	}
	return result
}

// for Insert User
func PostUser(con *sql.DB, UserCode string, Username string, PrivilegeCode string, GrpCode string, Pwd string, ExpDt string, NotifyInd string, HasQiscusAccount string, AvatarImage string, DeviceId string, CreateBy string, CreateDt string) (int64, error) {
	con = config.Connection()

	query := "INSERT INTO tbluser (UserCode, UserName, PrivilegeCode, GrpCode, Pwd, ExpDt, NotifyInd, HasqiscusAccount, AvatarImage, deviceid, CreateBy, CreateDt) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)"

	stmt, err := con.Prepare(query)

	if err != nil {
		fmt.Println(err)
	}

	defer stmt.Close()

	result, eror := stmt.Exec(UserCode, Username, PrivilegeCode, GrpCode, Pwd, ExpDt, NotifyInd, HasQiscusAccount, AvatarImage, DeviceId, CreateBy, CreateDt)

	if eror != nil {
		fmt.Println(eror)
	}

	return result.RowsAffected()
}

//function untuk untuk post data
func PostPrivileges(con *sql.DB, PrivilegeCode string, PrivilegeName string, CreateBy string, CreateDt string) (int64, error) {
	con = config.Connection()

	query := "INSERT INTO tblprivilege (PrivilegeCode, PrivilegeName, CreateBy, CreateDt) values (?,?,?,?)"
	stmt1, err1 := con.Prepare(query)

	if err1 != nil {
		panic(err1)
	}
	defer stmt1.Close()

	result, er1 := stmt1.Exec(PrivilegeCode, PrivilegeName, CreateBy, CreateDt)

	if er1 != nil {
		panic(er1)
	}

	return result.RowsAffected()
}
// function untuk update
func UpdatePrivileges(con *sql.DB, PrivilegeCode string, PrivilegeName string, LastupBy string, LastupDt string, PrivilegeCode_old string) (int64, error) {
	con = config.Connection()
	query := "UPDATE tblprivilege set PrivilegeCode = ?, PrivilegeName = ?, LastUpBy = ?, LastUpDt = ? WHERE PrivilegeCode = ?"

	stmt, err := con.Prepare(query)

	if err != nil {
		fmt.Println(err)
	}

	result, err2 := stmt.Exec(PrivilegeCode, PrivilegeName, LastupBy, LastupDt, PrivilegeCode_old)

	if err2 != nil {
		fmt.Println(err2)
	}

	return result.RowsAffected()
}
//func untuk delete data
func DeletePrivilege(c *CustomContext) Privileges {
	connection := config.Connection()
	grpcode := c.FormValue("privilegecode")
	query := "DELETE FROM tblprivilege WHERE tblprivilege.PrivilegeCode = ?"

	rows, eror := connection.Query(query, grpcode)
	if eror != nil {
		fmt.Println(eror)
	}
	defer rows.Close()
	result := Privileges{}

	if rows.Next() {
		privilege := Privilege{}
		eror2 := rows.Scan(&privilege.PrivilegeCode)
		if eror2 != nil {
			fmt.Println(eror2)
		}
		result.Privileges = append(result.Privileges, privilege)
	}
	return result
}

// Update data users
func UpdateUsers(con *sql.DB, UserCode string, Username string, PrivilegeCode string, GrpCode string, Pwd string, ExpDt string, NotifyInd string, HasQiscusAccount string, AvatarImage string, DeviceId string, LastupBy string, LastupDt string, UserCode_old string) (int64, error) {
	con = config.Connection()

	query := "UPDATE tbluser set UserCode = ?, UserName = ?, PrivilegeCode= ?, GrpCode = ?, Pwd = ?, ExpDt = ?, NotifyInd = ?, HasQiscusAccount = ?, AvatarImage = ?, deviceid = ?, LastUpBy = ?, LastUpDt = ? WHERE UserCode = ?"

	stmt, err := con.Prepare(query)

	if err != nil {
		panic(err)
	}

	result, eror := stmt.Exec(UserCode, Username, PrivilegeCode, GrpCode, Pwd, ExpDt, NotifyInd, HasQiscusAccount, AvatarImage, DeviceId, LastupBy, LastupDt, UserCode_old)

	if eror != nil {
		panic(eror)
	}
	return result.RowsAffected()
}

func DeleteUsers(c *CustomContext) Users {
	connection := config.Connection()
	usercode := c.FormValue("usercode")
	query := "DELETE FROM tbluser WHERE tbluser.UserCode = ?"

	rows, eror := connection.Query(query, usercode)
	if eror != nil {
		fmt.Println(eror)
	}
	defer rows.Close()
	result := Users{}

	if rows.Next() {
		user := User{}
		eror2 := rows.Scan(&user.UserCode)
		if eror2 != nil {
			fmt.Println(eror2)
		}
		result.Users = append(result.Users, user)
	}
	return result
}
