package org.vt.doi.alcoveserver;

import java.util.ArrayList;

import android.app.Activity;
import android.bluetooth.BluetoothAdapter;
import android.bluetooth.BluetoothDevice;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.os.Bundle;
import android.os.Handler;
import android.view.Window;
import android.view.WindowManager;
import android.view.animation.Animation;
import android.widget.ImageView;
import android.widget.Toast;

public class AlcoveServerActivity extends Activity {

	private BluetoothAdapter btAdapter;
	
	private ArrayList<String> targetDevices;
	private ArrayList<ImageView> images;
	private ArrayList<PausableScaleAnimation> anims;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		requestWindowFeature(Window.FEATURE_NO_TITLE);
		getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, 
                WindowManager.LayoutParams.FLAG_FULLSCREEN);
		setContentView(R.layout.main);

		btAdapter = BluetoothAdapter.getDefaultAdapter();

		// If the adapter is null, then Bluetooth is not supported
		if (btAdapter == null) {
			Toast.makeText(this, "Bluetooth is not available",
					Toast.LENGTH_LONG).show();
			finish();
			return;
		}

		if (!btAdapter.isEnabled()) {
			Intent enableIntent = new Intent(
					BluetoothAdapter.ACTION_REQUEST_ENABLE);
			startActivityForResult(enableIntent, RQ_ENABLE_BT);
		} else {
			setupContentView();
		}
	}

	@Override
	protected void onDestroy() {
		super.onDestroy();

		if (btAdapter != null) {
			btAdapter.cancelDiscovery();
		}

		unregisterReceiver(receiver);
	}

	private void setupContentView() {
		targetDevices = new ArrayList<String>();
		targetDevices.add("rfid1");
		targetDevices.add("rfid2");

		// Find all the ImageViews
		images = new ArrayList<ImageView>();
		images.add((ImageView) findViewById(R.id.main_image1));
		images.add((ImageView) findViewById(R.id.main_image2));
		images.add((ImageView) findViewById(R.id.main_image3));
		images.add((ImageView) findViewById(R.id.main_image4));
		images.add((ImageView) findViewById(R.id.main_image5));
		
		// Create all anims
		anims = new ArrayList<PausableScaleAnimation>();
		for (int i = 0; i < images.size(); i++) {
			PausableScaleAnimation anim = new PausableScaleAnimation(
					1.0f, 3.0f, 1.0f, 3.0f,
					Animation.RELATIVE_TO_SELF, 0.5f,
					Animation.RELATIVE_TO_SELF, 0.5f);
			anim = new PausableScaleAnimation(1.0f, 3.0f, 1.0f, 3.0f,
					Animation.RELATIVE_TO_SELF, 0.5f,
					Animation.RELATIVE_TO_SELF, 0.5f);
			anim.setStartOffset(0);
			anim.setDuration(3000);
			anim.setRepeatMode(Animation.REVERSE);
			anim.setRepeatCount(1);
			
			anims.add(anim);
		}

		startScanning();
	}
	
	private void startAnim(int pos) {
		images.get(pos).startAnimation(anims.get(pos));
	}
	
	private void toggleAnim(int pos) {
		PausableScaleAnimation anim = anims.get(pos);
		if (anim.isPaused()) {
			anim.resume();
		}
		else {
			anim.pause();
		}
	}

	private void startScanning() {
		// Register for broadcasts when a device is discovered
		IntentFilter filter = new IntentFilter(BluetoothDevice.ACTION_FOUND);
		registerReceiver(receiver, filter);

		// Register for broadcasts when discovery has finished
		filter = new IntentFilter(BluetoothAdapter.ACTION_DISCOVERY_FINISHED);
		registerReceiver(receiver, filter);

		btAdapter.startDiscovery();
	}

	private static final long DELAY = 10000;
	
	private BroadcastReceiver receiver = new BroadcastReceiver() {

		@Override
		public void onReceive(Context context, Intent intent) {
			String action = intent.getAction();

			if (BluetoothDevice.ACTION_FOUND.equals(action)) {
				BluetoothDevice device = intent
						.getParcelableExtra(BluetoothDevice.EXTRA_DEVICE);
				if (device.getBondState() != BluetoothDevice.BOND_BONDED) {
					// Spawn or extend life to an image if we like them
					String name = device.getName();
					System.out.println("found device: " + name);
					
					if (targetDevices.get(0).equals(name)) {
						// Trigger view 3 (index 2)
						if (!anims.get(2).isPaused()) {
							startAnim(2);
							
							pauseHandler1.postDelayed(pauseRunnable1, 2900);
							
							resumeHandler1.postDelayed(pauseRunnable1, DELAY);
						}
						else {
							resumeHandler1.removeCallbacks(pauseRunnable1);
							resumeHandler1.postDelayed(pauseRunnable1, DELAY);
						}
					}
					else if (targetDevices.get(1).equals(name)) {
						// Trigger 1 views (index 0)
						if (!anims.get(0).isPaused()) {
							startAnim(0);
							startAnim(4);
							
							pauseHandler2.postDelayed(pauseRunnable2, 2900);
							
							resumeHandler2.postDelayed(pauseRunnable2, DELAY);
						}
						else {
							resumeHandler2.removeCallbacks(pauseRunnable2);
							resumeHandler2.postDelayed(pauseRunnable2, DELAY);
						}
					}
				}
			} else if (BluetoothAdapter.ACTION_DISCOVERY_FINISHED
					.equals(action)) {
				// Infinite loop of discovery scanning
				btAdapter.startDiscovery();
			}
		}
	};

	private Handler pauseHandler1 = new Handler();
	private Runnable pauseRunnable1 = new Runnable() {

		@Override
		public void run() {
			toggleAnim(2);
		}
	};
	private Handler resumeHandler1 = new Handler();
	
	private Handler pauseHandler2 = new Handler();
	private Runnable pauseRunnable2 = new Runnable() {

		@Override
		public void run() {
			toggleAnim(0);
			toggleAnim(4);
		}
	};
	private Handler resumeHandler2 = new Handler();

	/*
	 * Activity Results.
	 */

	private static final int RQ_ENABLE_BT = 0;

	@Override
	public void onActivityResult(int requestCode, int resultCode, Intent data) {
		switch (requestCode) {
		case RQ_ENABLE_BT:
			if (resultCode == RESULT_OK) {
				setupContentView();
			} else {
				Toast.makeText(this, "No Bluetooth, goodbye",
						Toast.LENGTH_SHORT).show();
				finish();
			}
			break;
		default:
			break;
		}
	}
}