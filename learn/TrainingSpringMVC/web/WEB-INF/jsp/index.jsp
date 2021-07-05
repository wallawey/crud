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
        <h1>Simple CRUD - SpringMVC and Hibernate3</h1>
        <div class="paging">
          <c:if test="${!personList.firstPage}">
            <a href="index.html?page=previous"><b>&lt;&lt; Prev</b></a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </c:if>
          <c:if test="${!personList.lastPage}">
            <a href="index.html?page=next"><b>Next &gt;&gt;</b></a>
          </c:if>
        </div>
        <div class="data">
            <table border="0" cellpadding="4" cellspacing="0">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Date of Birth (dd-mm-yyyy)</th>
                    <th>Actions</th>
                </tr>
              <c:forEach var="person" items="${personList.pageList}">
                <tr>
                    <td>${person.id}</td>
                    <td>${person.name}</td>
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
                    <td><fmt:formatDate dateStyle="full" pattern="dd-MM-yyyy" value="${person.dob}"/></td>
                    <td>
                        <a href="view.html?personId=${person.id}" class="view">view</a>
                        <a href="update.html?personId=${person.id}" class="update">update</a>
                        <a href="delete.html?personId=${person.id}" class="delete">delete</a>
                    </td>
                </tr>
              </c:forEach>
              <c:if test="${personList.nrOfElements == 0}">
                <tr><td colspan="5">No Person Data</td></tr>
              </c:if>
            </table>
        </div>
        <br />
        <a href="add.html" class="add">add new person</a>
    </div>
</body>
</html>