package com.example.test54;

import androidx.annotation.NonNull;
import androidx.fragment.app.FragmentActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.example.test54.databinding.ActivityDriverBinding;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;
import com.example.test54.databinding.ActivityMapsBinding;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.firestore.FirebaseFirestore;
import com.google.firebase.firestore.GeoPoint;
import com.google.firebase.firestore.QueryDocumentSnapshot;
import com.google.firebase.firestore.QuerySnapshot;

public class DriverActivity extends FragmentActivity implements OnMapReadyCallback {

    private GoogleMap mMap;
    private ActivityDriverBinding binding;
    Button button;
    LatLng location;
    FirebaseFirestore db = FirebaseFirestore.getInstance();
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        binding = ActivityDriverBinding.inflate(getLayoutInflater());
        setContentView(R.layout.activity_driver);

        //Intent intent =new Intent(MapsActivity.this,MainActivity.class);

        button = findViewById(R.id.button);
        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                //intent.putExtra("location",location);
                //startActivity(intent);
                //startActivity( new Intent(MainActivity.this,MapsActivity.class));

            }
        });

        // Obtain the SupportMapFragment and get notified when the map is ready to be used.
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);
    }

    /**
     * Manipulates the map once available.
     * This callback is triggered when the map is ready to be used.
     * This is where we can add markers or lines, add listeners or move the camera. In this case,
     * we just add a marker near Sydney, Australia.
     * If Google Play services is not installed on the device, the user will be prompted to install
     * it inside the SupportMapFragment. This method will only be triggered once the user has
     * installed Google Play services and returned to the app.
     */
    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;

        // headquarters coordinates
        LatLng food54  = new LatLng(42.6448, 23.3389);

        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(food54,15f));


        db.collection("cities")
                .get()
                .addOnCompleteListener(new OnCompleteListener<QuerySnapshot>() {
                    @Override
                    public void onComplete(@NonNull Task<QuerySnapshot> task) {
                        if (task.isSuccessful()) {
                            for (QueryDocumentSnapshot document : task.getResult()) {
                                //Log.d(TAG, document.getId() + " => " + document.getData());

                                GeoPoint gpoint=document.getGeoPoint("location");
                                double lat = gpoint.getLatitude();
                                double lng = gpoint.getLongitude();
                                LatLng latLng = new LatLng(lat, lng);
                                mMap.addMarker(new MarkerOptions().position(latLng));

                            }
                        } else {
                            //Log.d(TAG, "Error getting documents: ", task.getException());
                        }
                    }
                });






    }



}
