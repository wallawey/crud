<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@taglib prefix="fmt" uri="http://java.sun.com/jsp/jstl/fmt" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Simple CRUD - SpringMVC and Hibernate3</title>
    <link href="style/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="content">
        <h1>${title}</h1>
        <div class="data">
            <table>
                <tr>
                    <td width="30%">ID</td>
                    <td>${person.id}</td>
                </tr>
                <tr>
                    <td valign="top">Name</td>
                    <td>${person.name}</td>
                </tr>
                <tr>
                    <td valign="top">Gender</td>
                    <td>
                        <c:choose>
                            <c:when test="${person.gender=='m'}">
                                Male
                            </c:when>
                            <c:when test="${person.gender=='f'}">
                                Female
                            </c:when>
                        </c:choose>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Date of birth (dd-mm-yyyy)</td>
                    <td><fmt:formatDate dateStyle="full" pattern="dd-MM-yyyy" value="${person.dob}"/></td>
                </tr>
            </table>
        </div>
        <br />
        <a href="index.html" class="back">back</a>
    </div>
</body>
</html>