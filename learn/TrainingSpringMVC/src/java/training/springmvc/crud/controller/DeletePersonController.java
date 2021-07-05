/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package training.springmvc.crud.controller;

import java.util.HashMap;
import java.util.Iterator;
import java.util.List;
import java.util.Map;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import org.springframework.beans.support.PagedListHolder;
import org.springframework.web.servlet.ModelAndView;
import org.springframework.web.servlet.mvc.Controller;
import training.springmvc.crud.model.Person;
import training.springmvc.crud.service.PersonService;

/**
 *
 * @author henri
 */
public class DeletePersonController implements Controller{

    private PersonService personService;
    public void setPersonService(PersonService personService) {
        this.personService = personService;
    }

    public ModelAndView handleRequest(HttpServletRequest request, HttpServletResponse response) throws Exception {
        Map model = new HashMap();

        Long id = Long.parseLong(request.getParameter("personId"));
        personService.deletePerson(id);

        PagedListHolder pagedListHolder = (PagedListHolder) request.getSession().getAttribute("personList");

        List personList = pagedListHolder.getSource();
        for(Iterator iterator = personList.iterator(); iterator.hasNext();){
            Person person = (Person) iterator.next();
            if(person.getId().equals(id)){
                personList.remove(person);
                break;
            }
        }
        pagedListHolder.setSource(personList);

        request.getSession().setAttribute("personList", pagedListHolder);
        model.put("personList", pagedListHolder);
        return new ModelAndView("index",model);
    }

}