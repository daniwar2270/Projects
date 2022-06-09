package com.example.test54;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import androidx.annotation.NonNull;

import android.content.Intent;
import android.util.Log;
import android.util.Patterns;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.OnFailureListener;
import com.google.android.gms.tasks.OnSuccessListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.AuthResult;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.firestore.DocumentReference;
import com.google.firebase.firestore.FirebaseFirestore;

import java.util.HashMap;
import java.util.Map;

public class RegisterActivity extends AppCompatActivity {
    Button btn2_signup;
    EditText user_name, pass_word;
    FirebaseAuth mAuth;
    FirebaseFirestore db = FirebaseFirestore.getInstance();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);
        user_name=findViewById(R.id.username);
        pass_word=findViewById(R.id.password1);
        btn2_signup=findViewById(R.id.sign);
        mAuth=FirebaseAuth.getInstance();
        btn2_signup.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String email = user_name.getText().toString().trim();
                String password= pass_word.getText().toString().trim();
                if(email.isEmpty())
                {
                    user_name.setError("Празно поле имейл");
                    user_name.requestFocus();
                    return;
                }
                if(!Patterns.EMAIL_ADDRESS.matcher(email).matches())
                {
                    user_name.setError("Моля въведете валиден имейл адрес!");
                    user_name.requestFocus();
                    return;
                }
                if(password.isEmpty())
                {
                    pass_word.setError("Празно поле парола!");
                    pass_word.requestFocus();
                    return;
                }
                if(password.length()<6)
                {
                    pass_word.setError("Дължината на паролата е малка от 6!");
                    pass_word.requestFocus();
                    return;
                }
                mAuth.createUserWithEmailAndPassword(email,password).addOnCompleteListener(new OnCompleteListener<AuthResult>() {

                    @Override
                    public void onComplete(@NonNull Task<AuthResult> task) {
                        if(task.isSuccessful())
                        {
                            Map<String, Object> user = new HashMap<>();
                            user.put("email", email);
                            user.put("uid", mAuth.getUid() );
                            user.put("role", "user");

                            db.collection("users")
                                    .add(user)
                                    .addOnSuccessListener(new OnSuccessListener<DocumentReference>() {
                                        @Override
                                        public void onSuccess(DocumentReference documentReference) {

                                        }
                                    })
                                    .addOnFailureListener(new OnFailureListener() {
                                        @Override
                                        public void onFailure(@NonNull Exception e) {

                                        }
                                    });


                            Toast.makeText(RegisterActivity.this,"Регистрацията е успешна!", Toast.LENGTH_SHORT).show();
                        }
                        else
                        {
                            Toast.makeText(RegisterActivity.this,"Потребител с такъв имейл адрес вече съществува!",Toast.LENGTH_SHORT).show();
                        }
                    }
                });

            }
        });

    }
}
