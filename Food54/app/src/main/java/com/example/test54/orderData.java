package com.example.test54;

public class orderData {

    String food,uid;
    int size;
    double lat,lon;

    orderData(String food,String uid,int size,double lat,double lon){
        this.food=food;
        this.uid = uid;
        this.size = size;
        this.lat=lat;
        this.lon = lon;

    }

    public double getLat() {
        return lat;
    }

    public double getLon() {
        return lon;
    }

    public int getSize() {
        return size;
    }

    public String getFood() {
        return food;
    }

    public String getUid() {
        return uid;
    }

    public void setFood(String food) {
        this.food = food;
    }

    public void setLat(double lat) {
        this.lat = lat;
    }

    public void setLon(double lon) {
        this.lon = lon;
    }

    public void setSize(int size) {
        this.size = size;
    }

    public void setUid(String uid) {
        this.uid = uid;
    }
}
