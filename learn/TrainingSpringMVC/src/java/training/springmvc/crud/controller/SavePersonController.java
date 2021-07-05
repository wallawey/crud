/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package training.springmvc.crud.controller;

import java.util.HashMap;
import java.util.Map;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import org.springframework.validation.BindException;
import org.springframework.web.servlet.ModelAndView;
import org.springframework.web.servlet.mvc.AbstractCommandController;
import training.springmvc.crud.model.Person;
import training.springmvc.crud.service.PersonService;

/**
 *
 * @author henri
 */
public class SavePersonController extends AbstractCommandController{

    private PersonService personService;
    public void setPersonService(PersonService personService) {
        this.personService = personService;
    }

    public SavePersonController(){
        this.setCommandClass(Person.class);
    }

    @Override
    protected ModelAndView handle(HttpServletRequest request, HttpServletResponse response, Object form, BindException errors) throws Exception {
        Map model = new HashMap();

        Person person = (Person) form;
        personService.savePerson(person);

        request.getSession().setAttribute("personList", null);

        model.put("title","Update Person");
        model.put("person",person);
        return new ModelAndView("personEdit", model);
    }

}