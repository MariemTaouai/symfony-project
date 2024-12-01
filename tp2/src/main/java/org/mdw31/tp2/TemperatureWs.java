package org.mdw31.tp2;

import jakarta.ws.rs.*;
import jakarta.ws.rs.core.MediaType;
import org.springframework.stereotype.Component;

import java.util.ArrayList;
import java.util.List;
@Component
@Path("/temperature")
public class TemperatureWs{
    private List<TemperatureData> lt = new ArrayList<TemperatureData>();


    @POST
    @Path("/add")
    @Consumes(MediaType.APPLICATION_JSON)
    @Produces(MediaType.TEXT_PLAIN)
    public String submitTemperatureData( TemperatureData d) {
        lt.add(d);
        return "Data received and processed";

    }
    @Path("/")
    @GET
    @Produces(MediaType.APPLICATION_JSON)
    public List<TemperatureData> getStoredTemperatureData() {
        return lt;
    }
    @DELETE
    @Path("/delete/{id}")
    @Consumes(MediaType.APPLICATION_JSON)
    public String supprimertemperaturedata(@PathParam("id")  String id ) {
        for (TemperatureData d : lt) {
            if (d.getSensorId().equals(id)) {
                lt.remove(d);
                return " removed";
            }
        }
        return "not found";
    }
    @PUT
    @Path("/update/{id}")
    @Consumes(MediaType.APPLICATION_JSON)
    @Produces(MediaType.TEXT_PLAIN)
    public String updateTemperatureData(@PathParam("id")  String id , double value){
        for (TemperatureData d : lt) {
            if (d.getSensorId().equals(id)) {
                d.setValue(value);
                return " updated";
            }
        }
        return " not found.";
    }
    @GET
    @Path("/filter/{value}")
    @Produces(MediaType.TEXT_PLAIN)
    public List<TemperatureData> filterTemperatureData(  double value) {
        List<TemperatureData> l = new ArrayList<>();
        for (TemperatureData d : lt) {
            if (d.getValue() >= value) {
                l.add(d);
            }
        }
        return l;
    }
}
