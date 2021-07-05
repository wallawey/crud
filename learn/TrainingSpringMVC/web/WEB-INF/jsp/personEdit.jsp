<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@taglib prefix="fmt" uri="http://java.sun.com/jsp/jstl/fmt" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Simple CRUD - SpringMVC and Hibernate3</title>
    <link href="style/style.css" rel="stylesheet" type="text/css" />
    <link href="style/calendar.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="script/calendar.js"></script>
</head>
<body>
    <div class="content">
        <h1><c:out value="${title}" default="Add New Person"/></h1>
        <form method="post" action="save.html">
        <div class="data">
            <table>
                <tr>
                    <td width="30%">ID</td>
                    <td><input type="text" name="id" disabled="disable" class="text" value="${person.id}"/></td>
                        <input type="hidden" name="id" value="${person.id}"/>
                </tr>
                <tr>
                    <td valign="top">Name</td>
                    <td><input type="text" name="name" class="text" value="${person.name}"/>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Gender</td>
                    <td><input type="radio" name="gender" value="m" <c:if test="${person.gender=='m'}">checked</c:if>/> Male
                        <input type="radio" name="gender" value="f" <c:if test="${person.gender=='f'}">checked</c:if>/> Female
                    </td>
                </tr>
                <tr>
                    <td valign="top">Date of birth (dd-mm-yyyy)</td>
                    <td><input type="text" name="dob_" onclick="displayDatePicker('dob_');" class="text" value="<fmt:formatDate dateStyle="full" pattern="dd-MM-yyyy" value="${person.dob}"/>"/>
                        <a href="javascript:void(0);" onclick="displayDatePicker('dob_');"><img src="style/images/calendar.png" alt="calendar" border="0"></a>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" value="Save"/></td>
                </tr>
            </table>
        </div>
        </form>
        <br />
        <a href="index.html" class="back">back</a>
    </div>
</body>
</html>