/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package training.springmvc.crud.service;

import java.util.List;
import training.springmvc.crud.dao.PersonDAO;
import training.springmvc.crud.model.Person;

/**
 *
 * @author henri
 */
public class PersonServiceImpl implements PersonService{

    private PersonDAO personDAO;
    public void setPersonDAO(PersonDAO personDAO) {
        this.personDAO = personDAO;
    }

    public List getPersonList() {
        return personDAO.getPersonList();
    }

    public Person getPerson(Long id){
        return personDAO.getPerson(id);
    }

    public void savePerson(Person person) {
        personDAO.savePerson(person);
    }

    public void deletePerson(Long id) {
        personDAO.deletePerson(id);
    }

}
